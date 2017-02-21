<?php

namespace App\Containers\Debugger\Tasks;

use App;
use DB;
use Illuminate\Support\Facades\Config;
use Log;

/**
 * Class QueryDebuggerTask.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class QueryDebuggerTask
{

    /**
     * Write the DB queries in the Log and Display them in the
     * terminal (in case you want to see them while executing the tests).
     *
     * @param bool|false $terminal
     */
    public function run($log = true, $terminal = false)
    {
        if (Config::get('debugger.queries.debug')) {
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
