---
title: "Middlewares"
category: "Optional Components"
order: 30
---

### Definition

Middleware provide a convenient mechanism for filtering HTTP requests entering your application. More about them [here](https://laravel.com/docs/middleware).

You can enable and disable Middlewares as you wish.

## Principles

- There's two types of Middlewares, General (applied on all the Routes by default) and Endpoints Middlewares (applied on some Endpoints).

- The Middlewares CAN be placed in Ship layer or the Container layer depend on their roles.

### Rules

- If the Middleware is written inside a Container it MUST be registered inside that Container.

- To register Middleware's in a Container the container needs to have `MiddlewareServiceProvider`. And like all other Container Providers it MUST be registered in the `MainServiceProvider` of that Container.

- General Middlewares (like some default Laravel Middleware's) SHOULD live in the Ship layer `app/Ship/Middlewares/*` and are registered in the Ship Main Provider.

- Third Party packages Middleware CAN be registered in Containers or on the Ship layer (wherever they make more sense). 
_Example: the `jwt.auth` middleware "provided by the JWT package" is registered in the Authentication Container (`Containers/Authentication/Providers/MiddlewareServiceProvider.php`)_.

### Folder Structure

```
 - App
   - Containers
       - {container-name}
           - Middlewares
           - WebAuthentication.php
   - Ship
       - Features
           - Middleware
              - Http
                 - EncryptCookies.php
                 - VerifyCsrfToken.php
```

### Code Sample

**Middleware Example:** 

```php
<?php

namespace App\Containers\Authentication\Middlewares;

use App\Ship\Engine\Butlers\Facades\ContainersButler;
use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * Class WebAuthentication
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class WebAuthentication extends Middleware
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->guest()) {
            return response()->view(ContainersButler::getLoginWebPageName(), [
                'errorMessage' => 'Credentials Incorrect.'
            ]);
        }

        return $next($request);
    }
}
	 
```


**Middleware registration inside the Container Example:** 

```php
<?php

namespace App\Containers\Authentication\Providers;

use App\Containers\Authentication\Middlewares\WebAuthentication;
use App\Ship\Parents\Providers\MiddlewareProvider;
use Tymon\JWTAuth\Middleware\GetUserFromToken;
use Tymon\JWTAuth\Middleware\RefreshToken;

class MiddlewareServiceProvider extends MiddlewareProvider
{

    protected $middleware = [

    ];

    protected $middlewareGroups = [
        'web' => [

        ],
        'api' => [

        ],
    ];

    protected $routeMiddleware = [
        'jwt.auth'         => GetUserFromToken::class,
        'jwt.refresh'      => RefreshToken::class,
        'auth:web'         => WebAuthentication::class,
    ];

    public function boot()
    {
        $this->loadContainersInternalMiddlewares();
    }

    public function register()
    {

    }
}
```

	 
**Middleware registration inside the Ship layer (HTTP Kernel) Example:** 

```php
<?php

namespace App\Ship\Engine\Kernels;

use App\Ship\Features\Middlewares\Http\ResponseHeadersMiddleware;
use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;

class ShipHttpKernel extends LaravelHttpKernel
{
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Ship\Features\Middlewares\Http\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Barryvdh\Cors\HandleCors::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Ship\Features\Middlewares\Http\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Ship\Features\Middlewares\Http\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            ResponseHeadersMiddleware::class,
            'throttle:60,1',
            'bindings',
        ],
    ];

    protected $routeMiddleware = [
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
    ];
}
```

