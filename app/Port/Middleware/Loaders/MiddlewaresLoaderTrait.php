<?php

namespace App\Port\Middleware\Loaders;

use App;
use App\Port\Middleware\PortKernel;
use DB;
use File;

/**
 * Class MiddlewaresLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait MiddlewaresLoaderTrait
{

    public function loadContainersInternalMiddlewares()
    {
        // TODO: might need refactoring to get rid of the functions on the PortKernel

        // Registering single and grouped middleware's
        $portKernel = App::make(PortKernel::class);
        $portKernel->registerMiddlewares($this->middleware);
        $portKernel->registerMiddlewareGroups($this->middlewareGroups);

        // Registering Route Middleware's
        foreach ($this->routeMiddleware as $key => $routeMiddleware) {
            $this->app['router']->middleware($key, $routeMiddleware);
        }
    }
}
