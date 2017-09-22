<?php

namespace App\Ship\Middlewares\Http;

use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;

/**
 * Class ProfilerMiddleware
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class ProfilerMiddleware extends Middleware
{

    /**
     * @param          $request
     * @param \Closure $next
     *
     * @return  mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (
            $response instanceof JsonResponse &&
            app()->bound('debugbar') &&
            Config::get('debugbar.enabled')
        ) {
            $profilerData = ['_profiler' => app('debugbar')->getData()];

            $response->setData($response->getData(true) + $profilerData);
        }

        return $response;
    }
}
