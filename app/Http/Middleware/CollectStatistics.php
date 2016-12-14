<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Services\StatsService;

class CollectStatistics
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
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->statsService->collectStats($request);
        $this->statsService->collectStats($request, Carbon::now()->format('Y-m-d-H'));

        return $next($request);
    }
}
