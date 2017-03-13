<?php

namespace App\Containers\Localization\Providers;

use App\Containers\Localization\Middlewares\Localization;
use App\Ship\Parents\Providers\MiddlewareProvider;

/**
 * Class MiddlewareServiceProvider.
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MiddlewareServiceProvider extends MiddlewareProvider
{
    /**
     * Register Container Middleware Groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            Localization::class,
        ],
        'api' => [
            Localization::class,
        ],
    ];

    /**
     * Register Route Middleware's.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // ..
    ];
}
