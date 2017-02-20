<?php

namespace App\Containers\Debugger\Traits;

use App;
use DB;
use Illuminate\Support\Facades\Config;
use Log;

/**
 * Class RequestsDebuggerTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait RequestsDebuggerTrait
{

    /**
     * @param $request
     * @param $response
     */
    public function runRequestDebugger($request, $response)
    {

        if (App::environment() != 'testing' && Config::get('app.debug') === true) {

            Log::debug('');
            Log::debug('');
            Log::debug('REQUEST START------------------------------------------------------');

            // Endpoint URL:
            Log::debug('URL: ' . $request->getMethod() . ' ' . $request->fullUrl());

            // Request Device IP:
            Log::debug('IP: ' . $request->ip());

            // Request Headers:
            Log::debug('App Headers: ');
            $authHead = $request->header('Authorization');
            $end = $authHead ? '...' : 'N/A';
            Log::debug('   Authorization = ' . substr($authHead, 0, 80) . $end);

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
        }
    }

}
