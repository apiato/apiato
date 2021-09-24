<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\MiddlewareProvider as AbstractMiddlewareProvider;

abstract class MiddlewareServiceProvider extends AbstractMiddlewareProvider
{
    protected array $middlewares = [];

    protected array $middlewareGroups = [];

    protected array $middlewarePriority = [];

    protected array $routeMiddleware = [];
}
