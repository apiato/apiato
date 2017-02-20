<?php

namespace App\Containers\Debugger\Traits;

use App;
use DB;
use Illuminate\Support\Facades\Config;
use Jenssegers\Agent\Facades\Agent;
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

        $responseDataCut = 700; // show only the first xxx character from the response
        $tokenDataCut = 80; // show only the first xxx character from the token

        if (App::environment() != 'testing' && Config::get('app.debug') === true) {

            Log::debug('');
            Log::debug('-----------------[] NEW REQUEST []---------------------------------------------------');

            Log::debug('REQUEST INFO: ');
            Log::debug('   Method: ' . $request->getMethod());
            Log::debug('   Endpoint: ' . $request->fullUrl());
            Log::debug('   IP: ' . $request->ip());
            Log::debug('   Languages: ' . implode(', ', Agent::languages()));

            Log::debug('');
            Log::debug('USER INFO: ');
            $authHead = $request->header('Authorization');
            $end = !is_null($authHead) ? '...' : 'N/A';
            Log::debug('   Authorization = ' . substr($authHead, 0, $tokenDataCut) . $end);
            $user = $request->user() ? 'ID: ' . $request->user()->id . ' | Name: ' . $request->user()->name : 'N/A';
            Log::debug('   User: ' . $user);
            Log::debug('   Platform: ' . Agent::platform());
            Log::debug('   Device: ' . Agent::device());
            $browser = Agent::browser();
            Log::debug('   Browser: ' . $browser . ' version ' . Agent::version($browser));

            Log::debug('');
            Log::debug('REQUEST DATA: ');
            $data = $request->all()? http_build_query($request->all(), '', ' + ') : 'N/A';
            Log::debug('   ' . $data);

            Log::debug('');
            Log::debug('RESPONSE DATA: ');
            $response = ($response && method_exists($response, 'content')) ? $response->content() : 'N/A';
            Log::debug('   ' . substr($response, 0, $responseDataCut) . '...');

            // ...

            Log::debug('');
        }
    }

}
