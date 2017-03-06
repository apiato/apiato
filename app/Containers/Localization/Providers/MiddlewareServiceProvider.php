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
     * Register Middleware's
     *
     * @var  array
     */
    protected $middlewares = [
        LocalizationMiddleware::class
    ];

    /**
     * Register Container Middleware Groups
     *
     * @var  array
     */
    protected $middlewareGroups = [
        'web' => [

        ],
        'api' => [

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
