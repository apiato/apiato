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

        $current_groups = $this->app['router']->getMiddlewareGroups();
        foreach ($middlewareGroups as $key => $middleware) {
            if(array_key_exists($key, $current_groups)){
                $new_group = array_merge($current_groups[$key], $middleware);
            }
            if ($middleware) {
                $this->app['router']->middlewareGroup($key, $new_group);
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
