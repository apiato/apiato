<?php

namespace App\Containers\Debugger\Providers;

use App\Containers\Debugger\Middlewares\RequestsMonitorMiddleware;
use App\Ship\Parents\Providers\MiddlewareProvider;

class MiddlewareServiceProvider extends MiddlewareProvider
{
    /**
     * Register Middlewares
     *
     * @var  array
     */
    protected array $middlewares = [
        RequestsMonitorMiddleware::class,
    ];

    /**
     * Register Container Middleware Groups
     *
     * @var  array
     */
    protected array $middlewareGroups = [
        'web' => [

        ],
        'api' => [

        ],
    ];

    /**
     * Register Route Middlewares
     *
     * @var  array
     */
    protected array $routeMiddleware = [
        // ..
    ];
}
