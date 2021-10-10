<?php

namespace App\Containers\AppSection\Authentication\Middlewares;

use App\Containers\AppSection\Authentication\Exceptions\EmailNotVerifiedException;
use App\Ship\Parents\Middlewares\Middleware as ParentMiddleware;
use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsVerified extends ParentMiddleware
{
    /**
     * Exclude these routes from authentication check.
     *
     * Note: `$request->is('api/fragment*')` https://laravel.com/docs/7.x/requests
     *
     * @var array
     */
    protected array $except = [
        'v1/oauth/token',
        'v1/clients/web/login',
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $redirectToRoute
     * @return mixed
     * @throws EmailNotVerifiedException
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null): mixed
    {
        if (!$this->emailVerificationRequired() || !$request->user()) {
            return $next($request);
        }

        foreach ($this->except as $excludedRoute) {
            if ($request->path() === $excludedRoute) {
                return $next($request);
            }
        }

        if (!$this->isEmailVerified($request->user())) {
            throw new EmailNotVerifiedException();
        }

        return $next($request);
    }

    private function emailVerificationRequired()
    {
        return config('appSection-authentication.require_email_verification');
    }

    private function isEmailVerified($user): bool
    {
        return !is_null($user->email_verified_at);
    }
}
