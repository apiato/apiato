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
     * @param array $middlewareGroups
     */
    private function registerMiddlewareGroups(array $middlewareGroups = [])
    {
        foreach ($middlewareGroups as $key => $middleware) {
            if ($middleware) {
                $this->app['router']->middlewareGroup($key, $middleware);
            }
        }
    }

    /**
     * Registering Route Middleware's
     *
     * @param array $routeMiddleware
     */
    private function registerRouteMiddleware(array $routeMiddleware = [])
    {
        foreach ($routeMiddleware as $key => $routeMiddleware) {
            $this->app['router']->aliasMiddleware($key, $routeMiddleware);
        }
    }
}
