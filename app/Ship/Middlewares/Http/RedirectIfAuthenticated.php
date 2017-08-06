<?php

namespace App\Ship\Middlewares\Http;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfAuthenticated
 *
 * A.K.A app/Http/Middleware/RedirectIfAuthenticated.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RedirectIfAuthenticated
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }

}
