<?php

namespace App\Containers\Authentication\Middlewares;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * Class WebAuthentication
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class WebAuthentication extends Middleware
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;


    /**
     * WebAuthentication constructor.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->guest()) {
            return redirect(Apiato::getLoginWebPageName())
                ->with('errorMessage', 'Credentials Incorrect.');
        }

        return $next($request);
    }
}
