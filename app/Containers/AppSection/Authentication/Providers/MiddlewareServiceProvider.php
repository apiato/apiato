<?php

namespace App\Containers\AppSection\Authentication\Providers;

use Apiato\Core\Middlewares\Http\RedirectIfAuthenticated;
use App\Ship\Parents\Providers\MiddlewareServiceProvider as ParentMiddlewareServiceProvider;

class MiddlewareServiceProvider extends ParentMiddlewareServiceProvider
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
        'guest' => RedirectIfAuthenticated::class,
    ];
}
