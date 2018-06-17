<?php

namespace App\Containers\Localization\Providers;

use App\Ship\Parents\Providers\MiddlewareProvider;
use App\Containers\Localization\Middlewares\LocalizationMiddleware;
use App\Containers\Localization\Middlewares\WebLocalizationMiddleware;

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

    ];

    /**
     * Register Container Middleware Groups
     *
     * @var  array
     */
    protected $middlewareGroups = [
        'web' => [
            WebLocalizationMiddleware::class,
        ],
        'api' => [
            LocalizationMiddleware::class,
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
