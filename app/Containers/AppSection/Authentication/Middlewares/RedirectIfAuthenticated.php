<?php

namespace App\Containers\AppSection\Authentication\Middlewares;

use App\Ship\Parents\Middlewares\Middleware as ParentMiddleware;
use App\Ship\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated extends ParentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse)  $next
     * @param string|null ...$guards
     * @return Response|RedirectResponse|null
     */
    public function handle(Request $request, Closure $next, ...$guards): Response|RedirectResponse|null
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
