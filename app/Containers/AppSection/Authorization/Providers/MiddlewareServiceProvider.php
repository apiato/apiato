<?php

namespace App\Containers\AppSection\Authorization\Providers;

use App\Ship\Parents\Providers\MiddlewareServiceProvider as ParentMiddlewareServiceProvider;
use Illuminate\Auth\Middleware\Authorize;

class MiddlewareServiceProvider extends ParentMiddlewareServiceProvider
{
    protected array $middlewares = [
        // ..
    ];

    protected array $middlewareGroups = [
        'web' => [

        ],
        'api' => [

        ],
    ];

    protected array $routeMiddleware = [
        // Laravel default route middleware's:
        'can' => Authorize::class,
    ];
}
