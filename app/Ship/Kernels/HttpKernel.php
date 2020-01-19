<?php

namespace App\Ship\Kernels;

use App\Ship\Middlewares\Http\Authenticate;
use App\Ship\Middlewares\Http\ProcessETagHeadersMiddleware;
use App\Ship\Middlewares\Http\ProfilerMiddleware;
use App\Ship\Middlewares\Http\ValidateJsonContent;
use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;

/**
 * Class HttpKernel
 *
 * A.K.A (app/Http/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class HttpKernel extends LaravelHttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Laravel middleware's
        \App\Ship\Middlewares\Http\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Ship\Middlewares\Http\TrustProxies::class,
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
            \App\Ship\Middlewares\Http\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Ship\Middlewares\Http\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
          // Note: The throttle Middleware is registered by the RoutesLoaderTrait in the Core
          ValidateJsonContent::class,
          'bindings',
          ProcessETagHeadersMiddleware::class,
          ProfilerMiddleware::class,
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
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'can'      => \Illuminate\Auth\Middleware\Authorize::class,
        'auth'     => Authenticate::class,
        'signed'   => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        // 'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        // 'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
      \Illuminate\Session\Middleware\StartSession::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      \App\Http\Middleware\Authenticate::class,
      \Illuminate\Routing\Middleware\ThrottleRequests::class,
      \Illuminate\Session\Middleware\AuthenticateSession::class,
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
      \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
