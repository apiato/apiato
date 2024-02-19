<?php

namespace App\Containers\AppSection\Authentication\Middlewares;

use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use App\Ship\Parents\Middlewares\Middleware as ParentMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated extends ParentMiddleware
{
    public function handle(Request $request, \Closure $next, string|null ...$guards): Response
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
