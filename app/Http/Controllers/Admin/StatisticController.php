<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\StatsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class StatisticController extends Controller
{
    /**
     * The StatsService instance.
     *
     * @var StatsService
     */
    protected $statsService;

    /**
     * Statistics constructor.
     *
     * @param StatsService $statsService
     */
    public function __construct(StatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    public function showGeneral()
    {
        $lastHour = (new Carbon())->format('Y-m-d-H');

        $platforms = $this->statsService->getZSetsStats("{$lastHour}:platform");
        $browsers = $this->statsService->getZSetsStats("{$lastHour}:browser");
        $referers = $this->statsService->getZSetsStats("{$lastHour}:referer");
        $pages = $this->statsService->getZSetsStats("{$lastHour}:page");
        $geos = $this->statsService->getZSetsStats("{$lastHour}:geo");

        return view('admin.stats', compact('platforms', 'browsers', 'referers', 'pages', 'geos'));
    }
}
