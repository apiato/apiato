<?php

namespace App\Containers\Debugger\Providers;

use App\Containers\Debugger\Middlewares\RequestsMonitorMiddleware;
use App\Ship\Parents\Providers\MiddlewareProvider;

/**
 * Class MiddlewareServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MiddlewareServiceProvider extends MiddlewareProvider
{

    /**
     * Register Container Middleware Groups
     *
     * @var  array
     */
    protected $middlewareGroups = [
        'web' => [

        ],
        'api' => [
            RequestsMonitorMiddleware::class,
        ],
    ];

    /**
     * Register Route Middleware's
     *
     * @var  array
     */
    protected $routeMiddleware = [
        // ..
    ];

}
