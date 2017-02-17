<?php

namespace App\Containers\Authorization\Providers;

use App\Ship\Middleware\Providers\PortMiddlewareServiceProvider;

/**
 * Class MiddlewareServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MiddlewareServiceProvider extends PortMiddlewareServiceProvider
{

    protected $middleware = [

    ];

    protected $middlewareGroups = [
        'web' => [

        ],
        'api' => [

        ],
    ];

    protected $routeMiddleware = [
        // Laravel default route middleware's:
        'can'      => \Illuminate\Auth\Middleware\Authorize::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->loadContainersInternalMiddlewares();
    }

    /**
     * Register anything in the container.
     */
    public function register()
    {

    }
}
