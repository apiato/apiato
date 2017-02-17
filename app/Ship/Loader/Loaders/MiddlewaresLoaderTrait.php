<?php

namespace App\Ship\Loader\Loaders;

use App;
use App\Ship\Kernel\ShipHttpKernel;

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
        // Get the singleton instance of the Shipo ShipoHttpKernel to
        // register all the application Middleware's
        $portHttpKernel = App::make(ShipHttpKernel::class);

        // Registering single and grouped middleware's
        $portHttpKernel->registerMiddlewares($this->middleware);
        $portHttpKernel->registerMiddlewareGroups($this->middlewareGroups);

        // Registering Route Middleware's apart
        foreach ($this->routeMiddleware as $key => $routeMiddleware) {
            $this->app['router']->aliasMiddleware($key, $routeMiddleware);
        }
    }
}
