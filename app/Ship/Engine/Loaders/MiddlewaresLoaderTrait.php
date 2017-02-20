<?php

namespace App\Ship\Engine\Loaders;

use App;

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
    public function loadMiddlewares()
    {
        $this->registerMiddlewareGroups($this->middlewareGroups);
        $this->registerRouteMiddleware($this->routeMiddleware);
    }


    /**
     * Registering Route Group's
     *
     * @void
     */
    private function registerMiddlewareGroups(array $middlewareGroups = [])
    {
        foreach ($middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }
    }

    /**
     * Registering Route Middleware's
     *
     * @void
     */
    private function registerRouteMiddleware(array $routeMiddleware = [])
    {
        foreach ($routeMiddleware as $key => $routeMiddleware) {
            $this->app['router']->aliasMiddleware($key, $routeMiddleware);
        }
    }


}
