<?php

namespace App\Containers\Debugger\Middlewares;

use App\Containers\Debugger\Tasks\RequestsDebuggerTask;
use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Illuminate\Http\Request;

/**
 * Class RequestsMonitorMiddleware
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RequestsMonitorMiddleware extends Middleware
{

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return  mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        (new RequestsDebuggerTask())->run($request, $response);

        return $response;
    }
}
