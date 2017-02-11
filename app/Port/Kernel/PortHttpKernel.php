<?php

namespace App\Port\Kernel;

use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;

/**
 * Class PortHttpKernel
 *
 * A.K.A (app/Http/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class PortHttpKernel extends LaravelHttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // Laravel default middleware's:
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        // CORS package middleware
        \Barryvdh\Cors\HandleCors::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // Laravel default middleware's:
            \App\Port\Middleware\Http\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Port\Middleware\Http\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            // Laravel default middleware's:
            'bindings',
            // Hello API Localization middleware
            \App\Port\Middleware\Http\Localization::class,
            // Dingo Package throttle middleware
            'api.throttle',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [

    ];


    /**
     * @param array $middlewares
     *
     * @return  $this
     */
    public function registerMiddlewares(array $middlewares = [])
    {
        $this->middleware = array_merge($this->middleware, $middlewares);

        return $this;
    }

    /**
     * @param array $middlewareGroups
     *
     * @return  $this
     */
    public function registerMiddlewareGroups(array $middlewareGroups = [])
    {
        $this->middlewareGroups = array_merge($this->middlewareGroups, $middlewareGroups);

        return $this;
    }

}
