<?php

namespace App\Containers\AppSection\Authentication\Middlewares;

use App\Ship\Parents\Middlewares\Middleware as ParentMiddleware;
use App\Ship\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated extends ParentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards): mixed
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect()->route(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
