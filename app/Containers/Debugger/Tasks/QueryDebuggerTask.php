<?php

namespace App\Containers\Debugger\Tasks;

use App;
use App\Ship\Parents\Tasks\Task;
use DB;
use Illuminate\Support\Facades\Config;
use Log;

/**
 * Class QueryDebuggerTask.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class QueryDebuggerTask extends Task
{

    /**
     * Write the DB queries in the Log and Display them in the
     * terminal (in case you want to see them while executing the tests).
     */
    public function run()
    {
        $debuggerEnabled = Config::get('debugger.queries.debug');

        if ($debuggerEnabled) {

            $consoleOutputEnabled = Config::get('debugger.queries.output.console');
            $logOutputEnabled = Config::get('debugger.queries.output.log');

            DB::listen(function ($event) use ($consoleOutputEnabled, $logOutputEnabled) {
                $fullQuery = vsprintf(str_replace(['%', '?'], ['%%', '%s'], $event->sql), $event->bindings);

                $result = $event->connectionName . ' (' . $event->time . '): ' . $fullQuery;

                if ($consoleOutputEnabled) {
                    dump($result);
                }

                if ($logOutputEnabled) {
                    Log::info($result);
                }
            });
        }
    }

}
