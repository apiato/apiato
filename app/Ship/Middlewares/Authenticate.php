<?php

declare(strict_types=1);

namespace App\Ship\Middlewares;

use Apiato\Core\Middlewares\Http\Authenticate as CoreMiddleware;

class Authenticate extends CoreMiddleware
{
    #[\Override]
    protected function redirectTo($request): null|string
    {
        if ($request->expectsJson()) {
            return null;
        }

        return route('login');
    }
}
