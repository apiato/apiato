<?php

namespace App\Ship\Middlewares;

use Apiato\Core\Middlewares\Http\Authenticate as CoreMiddleware;
use App\Ship\Providers\RouteServiceProvider;

class Authenticate extends CoreMiddleware
{
    protected function redirectTo($request): ?string
    {
        return $request->expectsJson() ? null : route(RouteServiceProvider::LOGIN);
    }
}
