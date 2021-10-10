<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Containers\AppSection\Authentication\Middlewares\EnsureEmailIsVerified;
use App\Containers\AppSection\Authentication\Middlewares\RedirectIfAuthenticated;
use App\Ship\Parents\Providers\MiddlewareServiceProvider as ParentMiddlewareServiceProvider;

class MiddlewareServiceProvider extends ParentMiddlewareServiceProvider
{
    protected array $middlewares = [];

    protected array $middlewareGroups = [
        'api' => [
            EnsureEmailIsVerified::class,
        ],
    ];

    protected array $middlewarePriority = [];

    protected array $routeMiddleware = [
        'guest' => RedirectIfAuthenticated::class,
    ];
}
