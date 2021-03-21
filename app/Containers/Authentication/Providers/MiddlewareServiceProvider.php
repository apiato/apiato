<?php

namespace App\Containers\Authentication\Providers;

use App\Containers\Authentication\Middlewares\WebAuthentication;
use App\Ship\Parents\Providers\MiddlewareProvider;

class MiddlewareServiceProvider extends MiddlewareProvider
{
    protected array $middlewares = [
        // ..
    ];

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
    ];
}
