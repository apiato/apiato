<?php

namespace App\Ship\Engine\Loaders;

use App;
use Illuminate\Contracts\Http\Kernel;

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
        $this->registerMiddleware(isset($this->middlewares) ? $this->middlewares : []);
        $this->registerMiddlewareGroups((isset($this->middlewareGroups) ? $this->middlewareGroups : []));
        $this->registerRouteMiddleware((isset($this->routeMiddleware) ? $this->routeMiddleware : []));
    }

    /**
     * Registering Route Group's
     *
     * @param array $middlewareGroups
     */
    private function registerMiddleware(array $middlewares = [])
    {
        $httpKernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);

        foreach ($middlewares as $middleware) {
            $httpKernel->prependMiddleware($middleware);
        }
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
