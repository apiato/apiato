<?php

namespace App\Containers\Authentication\Providers;

use App\Containers\Authentication\Middlewares\WebAuthentication;
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
    protected array $middlewares = [
        // ..
    ];

    /**
     * Register Container Middleware Groups
     *
     * @var  array
     */
    protected array $middlewareGroups = [
        'web' => [
            // ..
        ],
        'api' => [
            // ..
        ],
    ];

    protected array $routeMiddleware = [
        // apiato User Authentication middleware for Web Pages
        'auth:web' => WebAuthentication::class,

        // ..
    ];

}
