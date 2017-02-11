<?php

namespace App\Port\Loader\Loaders;

use App;
use App\Port\Kernel\PortHttpKernel;

/**
 * Class MiddlewaresLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait MiddlewaresLoaderTrait
{

    /**
     * @void
     */
    public function loadContainersInternalMiddlewares()
    {
        // Get the singleton instance of the Porto PortoHttpKernel to
        // register all the application Middleware's
        $portHttpKernel = App::make(PortHttpKernel::class);

        // Registering single and grouped middleware's
        $portHttpKernel->registerMiddlewares($this->middleware);
        $portHttpKernel->registerMiddlewareGroups($this->middlewareGroups);

        // Registering Route Middleware's apart
        foreach ($this->routeMiddleware as $key => $routeMiddleware) {
            $this->app['router']->middleware($key, $routeMiddleware);
        }
    }
}
