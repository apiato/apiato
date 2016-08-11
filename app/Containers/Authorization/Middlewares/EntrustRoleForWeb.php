<?php

namespace App\Containers\Authorization\Middlewares;

use App\Port\Butler\Portals\PortButler;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class EntrustRoleForWeb
{

    protected $auth;

    /**
     * @var  \App\Port\Butler\Portals\PortButler
     */
    private $portButler;

    /**
     * Creates a new instance of the middleware.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth, PortButler $portButler)
    {
        $this->auth = $auth;
        $this->portButler = $portButler;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure                  $next
     * @param                           $roles
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if ($this->auth->guest() || !$request->user()->hasRole(explode('|', $roles))) {
            return view($this->portButler->getLoginWebPageName());
        }

        return $next($request);
    }
}
