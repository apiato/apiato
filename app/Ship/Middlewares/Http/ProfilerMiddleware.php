<?php

namespace App\Ship\Middlewares\Http;

use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ProfilerMiddleware extends Middleware
{
    public function handle(Request $request, Closure $next)
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
