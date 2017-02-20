<?php

namespace App\Containers\Authentication\Providers;

use App\Containers\Authentication\Middlewares\WebAuthentication;
use App\Ship\Parents\Providers\MiddlewareProvider;
use Tymon\JWTAuth\Middleware\GetUserFromToken;
use Tymon\JWTAuth\Middleware\RefreshToken;

/**
 * Class MiddlewareServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MiddlewareServiceProvider extends MiddlewareProvider
{

    protected $middlewareGroups = [
        'web' => [

        ],
        'api' => [

        ],
    ];

    protected $routeMiddleware = [
        // JWT Package middleware's
        'jwt.auth'         => GetUserFromToken::class,
        'jwt.refresh'      => RefreshToken::class,

        // Hello API User Authentication middleware for Web Pages
        'web.auth'         => WebAuthentication::class,
    ];

}
