<?php

namespace App\Ship\Middlewares\Http;

use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;

/**
 * Class ProfilerMiddleware
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
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

        if (!Config::get('debugbar.enabled')) {
            return $response;
        }

        if ($response instanceof JsonResponse && app()->bound('debugbar')) {
            $profilerData = ['_profiler' => app('debugbar')->getData()];

            $response->setData($response->getData(true) + $profilerData);
        }

        return $response;
    }
}
