<?php

namespace App\Port\Middleware;

use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;

/**
 * Class PortKernel
 *
 * A.K.A (app/Http/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class PortKernel extends LaravelHttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // Laravel default middleware's:
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
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
            // Hello API Requests Monitor
            \App\Containers\Debugger\Middlewares\RequestsMonitorMiddleware::class,
            // CORS package middleware
            \Barryvdh\Cors\HandleCors::class,
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
        // Laravel default route middleware's:
        'can'              => \Illuminate\Auth\Middleware\Authorize::class,
        'bindings'         => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        // JWT Package middleware's
        'jwt.auth'         => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh'      => \Tymon\JWTAuth\Middleware\RefreshToken::class,
        // Entrust Package middleware's
        'role'             => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission'       => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability'          => \Zizaco\Entrust\Middleware\EntrustAbility::class,
        // By Hello API
        'role.web'         => \App\Containers\Authorization\Middlewares\EntrustRoleForWeb::class,
        // Hello API Visitor User Authentication middleware
        'api.auth.visitor' => \App\Containers\Authentication\Middlewares\VisitorsAuthentication::class,
        // Hello API User Authentication middleware for Web Pages
        'web.auth'         => \App\Containers\Authentication\Middlewares\WebAuthentication::class,
        // ...
    ];

}
