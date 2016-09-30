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
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return  mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $response = $next($request);

        if (App::environment() != 'testing' && Config::get('app.debug') === true) {

            Log::debug('');
            Log::debug('');
            Log::debug('REQUEST START-------------------------------------------------------');

            // Endpoint URL:
            Log::debug('URL: ' . $request->getMethod() . ' ' . $request->fullUrl());

            // Request Device IP:
            Log::debug('IP: ' . $request->ip());

            // Request Headers:
            Log::debug('App Headers: ');
            Log::debug('   Authorization = ' . substr($request->header('Authorization'), 0, 80) . '...');
            Log::debug('   Visitor-Id = ' . $request->header('Visitor-Id'));

            // Request Data:
            if ($request->all()) {
                $data = http_build_query($request->all(), '', ' ; ');
            } else {
                $data = 'N/A';
            }
            Log::debug('Request Data: ' . $data);

            // Authenticated User:
            if ($request->user()) {
                $user = 'ID: ' . $request->user()->id;
            } else {
                $user = 'N/A';
            }
            Log::debug('Authenticated User: ' . $user);

            // Response Content:
            if ($response && method_exists($response, 'content')) {
                Log::debug('Response: ' . substr($response->content(), 0, 700) . '...');
            }

            Log::debug('');
            Log::debug('');

        }

        // Perform action

        return $response;
    }
}
