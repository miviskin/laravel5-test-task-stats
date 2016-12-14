<?php

namespace App\Http\Middleware;

use Closure;
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
        $this->statsService->collect($request);

        return $next($request);
    }
}
