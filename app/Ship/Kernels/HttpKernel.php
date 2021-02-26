<?php

namespace App\Ship\Kernels;

use App\Ship\Middlewares\Http\Authenticate;
use App\Ship\Middlewares\Http\EncryptCookies;
use App\Ship\Middlewares\Http\ProcessETagHeadersMiddleware;
use App\Ship\Middlewares\Http\ProfilerMiddleware;
use App\Ship\Middlewares\Http\TrimStrings;
use App\Ship\Middlewares\Http\TrustProxies;
use App\Ship\Middlewares\Http\ValidateJsonContent;
use App\Ship\Middlewares\Http\VerifyCsrfToken;
use Fruitcake\Cors\HandleCors;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

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
        TrimStrings::class,
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrustProxies::class,
        ConvertEmptyStringsToNull::class,

      // CORS package middleware
        HandleCors::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
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
        'bindings' => SubstituteBindings::class,
        'throttle' => ThrottleRequests::class,
        'can'      => Authorize::class,
        'auth'     => Authenticate::class,
        'signed'   => ValidateSignature::class,
        'cache.headers' => SetCacheHeaders::class,
        'password.confirm' => RequirePassword::class,
        'verified' => EnsureEmailIsVerified::class,
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
      StartSession::class,
      ShareErrorsFromSession::class,
      Authenticate::class,
      ThrottleRequests::class,
      AuthenticateSession::class,
      SubstituteBindings::class,
      Authorize::class,
    ];
}
