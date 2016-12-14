<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\StatsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class StatsController extends Controller
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

    /**
     * Show general stats.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showGeneral(Request $request)
    {
        $platforms = $this->statsService->getZSetsStats("general:platform");
        $browsers = $this->statsService->getZSetsStats("general:browser");
        $referers = $this->statsService->getZSetsStats("general:referer");
        $pages = $this->statsService->getZSetsStats("general:page");
        $geos = $this->statsService->getZSetsStats("general:geo");

        return view('admin.stats', compact('platforms', 'browsers', 'referers', 'pages', 'geos'));
    }

    /**
     * Show stats by range.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRange(Request $request)
    {
        $rangeStart = $request->has('rangeStart')
            ? Carbon::createFromFormat('Y-m-d-H', $request->get('rangeStart'))
            : Carbon::now()->subDay();

        $rangeEnd = $request->has('rangeEnd')
            ? Carbon::createFromFormat('Y-m-d-H', $request->get('rangeEnd'))
            : Carbon::now();

        $stats = $this->statsService->getRangeStats('browser', $rangeStart, $rangeEnd);

        dd($stats);

//        $lastHour = (new Carbon())->format('Y-m-d-H');
//
//        $platforms = $this->statsService->getZSetsStats("{$lastHour}:platform");
//        $browsers = $this->statsService->getZSetsStats("{$lastHour}:browser");
//        $referers = $this->statsService->getZSetsStats("{$lastHour}:referer");
//        $pages = $this->statsService->getZSetsStats("{$lastHour}:page");
//        $geos = $this->statsService->getZSetsStats("{$lastHour}:geo");
//
//        return view('admin.stats', compact('platforms', 'browsers', 'referers', 'pages', 'geos'));
    }
}
