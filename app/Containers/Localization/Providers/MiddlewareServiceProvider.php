<?php

namespace App\Containers\Localization\Providers;

use App\Containers\Localization\Middlewares\LocalizationMiddleware;
use App\Ship\Parents\Providers\MiddlewareProvider;

/**
 * Class MiddlewareServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MiddlewareServiceProvider extends MiddlewareProvider
{

    /**
     * Register Middlewares
     *
     * @var  array
     */
    protected array $middlewares = [

    ];

    /**
     * Register Container Middleware Groups
     *
     * @var  array
     */
    protected array $middlewareGroups = [
        'web' => [
            LocalizationMiddleware::class,
        ],
        'api' => [
            LocalizationMiddleware::class,
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
