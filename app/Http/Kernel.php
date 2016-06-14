<?php

namespace Hello\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // Laravel default middleware's
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Hello\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

        // removing some of the Laravel's default middleware's
        //        \Illuminate\Session\Middleware\StartSession::class,
        //        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        //        \Hello\Http\Middleware\VerifyCsrfToken::class,

        // CORS Package middleware's
        \Barryvdh\Cors\HandleCors::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // removing the Laravel's default route middleware's
        //        'auth' => \Hello\Http\Middleware\Authenticate::class,
        //        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        //        'guest' => \Hello\Http\Middleware\RedirectIfAuthenticated::class,

        // JWT Package middleware's
        'jwt.auth'    => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class,

        // Entrust Package middleware's
        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,

        // ...

    ];
}
