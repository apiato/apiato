<?php

namespace App\Containers\Authentication\Middlewares;

use App\Ship\Engine\Butlers\ContainersButler;
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
     * @var  \App\Ship\Engine\Butlers\ContainersButler
     */
    private $portButler;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth, ContainersButler $portButler)
    {
        $this->auth = $auth;
        $this->portButler = $portButler;
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
            return response()->view($this->portButler->getLoginWebPageName());
        }

        return $next($request);
    }
}
