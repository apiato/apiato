<?php

namespace App\Containers\Debugger\Middlewares;

use App;
use Closure;
use Config;
use Illuminate\Http\Request;
use Log;

/**
 * Class RequestsMonitorMiddleware
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RequestsMonitorMiddleware
{

    /**
     * Whenever the request doesn't have an Authorization header (token)
     * it must have a an visitor-id header.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (App::environment() != 'testing' || Config::get('app.debug') === true) {

            Log::debug('');
            Log::debug('REQUEST START-------------------------------------------------------');

            Log::debug('IP: ' . $request->ip());

            Log::debug('URL: ' . $request->getMethod() . ' - ' . $request->fullUrl());

            if ($request->user()) {
                $user = 'ID: ' . $request->user->id . ' | Name: ' . $request->user->name;
            } else {
                $user = 'NULL';
            }
            Log::debug('User: ' . $user);

            if ($request->all()) {
                $data = http_build_query($request->all(), '', ' ; ');
            } else {
                $data = 'NULL';
            }
            Log::debug('DATA: ' . $data);

            Log::debug('');

        }

        // return the response
        return $next($request);
    }
}
