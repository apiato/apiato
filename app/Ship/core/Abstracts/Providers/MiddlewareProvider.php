<?php

namespace Apiato\Core\Abstracts\Providers;

use Apiato\Core\Loaders\MiddlewaresLoaderTrait;

/**
 * Class MiddlewareProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class MiddlewareProvider extends MainProvider
{
    use MiddlewaresLoaderTrait;

    protected array $middlewares = [];

    protected array $middlewareGroups = [];

    protected array $routeMiddleware = [];

    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->loadMiddlewares();
    }

    /**
     * Register anything in the container.
     */
    public function register(): void
    {

    }
}
