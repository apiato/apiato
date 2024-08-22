<?php

namespace App\Ship\Middlewares;

use Apiato\Core\Middlewares\Http\Authenticate as CoreMiddleware;

class Authenticate extends CoreMiddleware
{
    protected function redirectTo($request): string|null
    {
        if ($request->expectsJson()) {
            return null;
        }

        return route('login');
    }
}
