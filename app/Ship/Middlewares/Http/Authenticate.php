<?php

namespace App\Ship\Middlewares\Http;

use App\Ship\Exceptions\AuthenticationException;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as LaravelAuthenticate;
use Illuminate\Support\Facades\Config;

class Authenticate extends LaravelAuthenticate
{
    public function authenticate($request, array $guards): void
    {
        try {
            parent::authenticate($request, $guards);
        } catch (Exception $exception) {
            if ($request->expectsJson()) {
                throw new AuthenticationException();
            } else {
                $this->unauthenticated($request, $guards);
            }
        }
    }

    protected function redirectTo($request): ?string
    {
        return route(Config::get('appSection-authentication.login-page-url'));
    }
}
