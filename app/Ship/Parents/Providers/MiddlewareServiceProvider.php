<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\MiddlewareServiceProvider as AbstractMiddlewareServiceProvider;

abstract class MiddlewareServiceProvider extends AbstractMiddlewareServiceProvider
{
    protected array $middlewares = [];

    protected array $middlewareGroups = [];

    protected array $middlewareAliases = [];

    protected array $middlewarePriority = [];
}
