<?php

namespace App\Containers\Localization\Providers;

use App\Ship\Parents\Providers\MiddlewareProvider;

/**
 * Class MiddlewareServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MiddlewareServiceProvider extends MiddlewareProvider
{

    protected $middlewareGroups = [
        'web' => [
            \App\Containers\Localization\Middlewares\Localization::class
        ],
        'api' => [
            \App\Containers\Localization\Middlewares\Localization::class
        ],
    ];

    protected $routeMiddleware = [
        // ..
    ];

}
