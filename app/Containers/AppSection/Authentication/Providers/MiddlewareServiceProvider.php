<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Containers\AppSection\Authentication\Middlewares\RedirectIfAuthenticated;
use App\Ship\Parents\Providers\MiddlewareServiceProvider as ParentMiddlewareServiceProvider;

class MiddlewareServiceProvider extends ParentMiddlewareServiceProvider
{
    protected array $middlewares = [];

    protected array $middlewareGroups = [];

    protected array $middlewareAliases = [
        'guest' => RedirectIfAuthenticated::class,
    ];

    protected array $middlewarePriority = [];
}
