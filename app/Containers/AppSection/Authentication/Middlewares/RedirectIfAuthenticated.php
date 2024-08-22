<?php

namespace App\Containers\AppSection\Authentication\Middlewares;

use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use App\Ship\Parents\Middlewares\Middleware as ParentMiddleware;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated extends ParentMiddleware
{
    public function handle(Request $request, \Closure $next, string|null ...$guards): Response|RedirectResponse|null
    {
        $guards = [] === $guards ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect()->action(HomePageController::class);
            }
        }

        return $next($request);
    }
}
