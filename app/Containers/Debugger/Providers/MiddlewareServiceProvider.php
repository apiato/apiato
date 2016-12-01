<?php

namespace App\Containers\Debugger\Providers;

use App\Containers\Debugger\Middlewares\RequestsMonitorMiddleware;
use App\Port\Middleware\Providers\PortMiddlewareServiceProvider;

/**
 * Class MiddlewareServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MiddlewareServiceProvider extends PortMiddlewareServiceProvider
{

    protected $middleware = [

    ];

    protected $middlewareGroups = [
        'web' => [

        ],
        'api' => [
            // Hello API Requests Monitor
            RequestsMonitorMiddleware::class,
        ],
    ];

    protected $routeMiddleware = [

    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerAllMiddlewares($this->middleware, $this->middlewareGroups, $this->routeMiddleware);
    }

    /**
     * Register anything in the container.
     */
    public function register()
    {

    }
}
