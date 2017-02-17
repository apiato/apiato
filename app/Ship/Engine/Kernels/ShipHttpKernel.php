<?php

namespace App\Ship\Engine\Kernels;

use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;

/**
 * Class ShipHttpKernel
 *
 * A.K.A (app/Http/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ShipHttpKernel extends LaravelHttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Laravel middleware's:
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Ship\Features\Middlewares\Http\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

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
            \App\Ship\Features\Middlewares\Http\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Ship\Features\Middlewares\Http\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // Laravel middleware's:
            'bindings',

            // Dingo Package throttle middleware
            'api.throttle',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
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
