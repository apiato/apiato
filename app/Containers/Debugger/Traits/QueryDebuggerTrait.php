<?php

namespace App\Containers\Debugger\Traits;

use App;
use DB;
use Illuminate\Support\Facades\Config;
use Log;

/**
 * Class QueryDebuggerTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait QueryDebuggerTrait
{

    /**
     * Write the DB queries in the Log and Display them in the
     * terminal (in case you want to see them while executing the tests).
     *
     * @param bool|false $terminal
     */
    public function runQueryDebugger($log = true, $terminal = false)
    {
        if (Config::get('hello.query_debugger')) {
            DB::listen(function ($event) use ($terminal, $log) {
                $fullQuery = vsprintf(str_replace(['%', '?'], ['%%', '%s'], $event->sql), $event->bindings);

                $text = $event->connectionName . ' (' . $event->time . '): ' . $fullQuery;

                if ($terminal) {
                    dump($text);
                }

                if ($log) {
                    Log::info($text);
                }
            });
        }
    }

}
