<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;
use Torann\GeoIP\Facades\GeoIP;

class StatsService
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * @var string
     */
    protected $prefix = 'stats';

    /**
     * Statistics constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Collect statistics
     *
     * @param Request $request
     */
    public function collect(Request $request)
    {
        $lastHour = (new Carbon())->format('Y-m-d-H');
        $keyPrefix = "{$this->prefix}:{$lastHour}";
        $ip = $request->server('REMOTE_ADDR');

        $collects = [
            'platform' => $this->getPlatformName($request),
            'browser' => $this->getBrowserName($request),
            'referer' => $this->getRefererHost($request),
            'page' => $this->getPageUri($request),
            'geo' => GeoIP::getLocation($ip)->iso_code,
        ];

        $isUniqueIp = !Redis::sismember("{$keyPrefix}:ip", $ip);
        $isUniqueCookie = !Cookie::get($this->app['config']['session']['cookie']);

        Redis::pipeline(function ($pipe) use ($keyPrefix, $collects, $ip, $isUniqueIp, $isUniqueCookie) {
            foreach ($collects as $name => $value) {
                $pipe->zIncrBy("{$keyPrefix}:{$name}", 1, $value);
                $pipe->zIncrBy("{$keyPrefix}:{$name}:{$value}", 1, 'hits');

                if ($isUniqueIp) {
                    $pipe->zIncrBy("{$keyPrefix}:{$name}:{$value}", 1, 'uniqueIp');
                }

                if ($isUniqueCookie) {
                    $pipe->zIncrBy("{$keyPrefix}:{$name}:{$value}", 1, 'uniqueCookie');
                }
            }

            if ($isUniqueIp) {
                $pipe->sadd("{$keyPrefix}:ip", $ip);
            }
        });
    }

    /**
     * Get zSets stats by given key.
     *
     * @param string $key
     * @param int $limit
     * @return array
     */
    public function getZSetsStats($key, $limit = 10)
    {
        $names = Redis::zRevRange("{$this->prefix}:{$key}", 0, $limit - 1);
        $stats = Redis::pipeline(function ($pipe) use ($key, $names) {
            foreach ($names as $name) {
                $pipe->zRevRange("{$this->prefix}:{$key}:{$name}", 0, -1, 'WITHSCORES');
            }
        });

        return array_combine($names, $stats);
    }

    /**
     * Get browser name.
     *
     * @param Request $request
     * @return int|string
     */
    public function getBrowserName(Request $request)
    {
        $browsers = [
            'IExplorer' => 'MSIE|Trident',
            'Opera'     => 'opera|OPR',
            'Firefox'   => 'Firefox',
            'Chrome'    => 'Chrome|CriOS',
            'Safari'    => 'Safari',
            'Mozilla'   => 'mozilla',
        ];

        foreach ($browsers as $name => $regexp) {
            if (preg_match("~{$regexp}~i", $request->server('HTTP_USER_AGENT'))) {
                return $name;
            }
        }

        return 'Unknown';
    }

    /**
     * Get refferer host.
     *
     * @param Request $request
     * @return mixed
     */
    public function getRefererHost(Request $request)
    {
        if (preg_match('~^.*//(?:www\.)?([^\s/:]+)~', $request->server('HTTP_REFERER'), $match)) {
            return $match[1];
        }

        return 'bookmarks';
    }

    /**
     * Get platform name.
     *
     * @param Request $request
     * @return int|string
     */
    public function getPlatformName(Request $request)
    {
        $platforms = [
            'Win8.1'      => 'windows nt 6.3',
            'Win8'        => 'windows nt 6.2',
            'Win7'        => 'windows nt 6.1',
            'WinVista'    => 'windows nt 6.0',
            'Win2003'     => 'windows nt 5.2',
            'WinXP'       => 'windows nt 5.1',
            'Win2000'     => 'windows nt 5.0',
            'WinNT'       => 'windows nt 4.0|winnt',
            'Win98'       => 'windows 98|win98',
            'Win95'       => 'windows 95|win95',
            'WinPhone'    => 'windows phone',
            'WinCE'       => 'mspie|pocket|IEMobile|windows ce',
            'Win'         => 'windows',
            'Symbian'     => 'symbian',
            'iOS'         => 'iPad|iPod|iPhone',
            'MacOSX'      => 'os x',
            'Macintosh'   => 'mac|ppc',
            'Android'     => 'android',
            'Linux'       => 'linux|gnu',
            'BlackBerry'  => 'BlackBerry',
            'FreeBSD'     => 'FreeBSD',
            'OpenBSD'     => 'OpenBSD',
            'NetBSD'      => 'NetBSD',
            'OpenSolaris' => 'OpenSolaris',
            'SunOS'       => 'SunOS',
            'OS/2'        => 'OS/2',
            'BeOS'        => 'BeOS',
            'Debian'      => 'debian',
            'Unix'        => 'unix',
        ];

        foreach ($platforms as $name => $regexp) {
            if (preg_match("~{$regexp}~i", $request->server('HTTP_USER_AGENT'))) {
                return $name;
            }
        }

        return 'Unknown';
    }

    /**
     * Get page uri.
     *
     * @param Request $request
     * @return string
     */
    public function getPageUri(Request $request)
    {
        return '/' . ltrim($request->path(), '/');
    }
}
