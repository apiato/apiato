<?php

namespace App\Port\Commands\Traits;

/**
 * Class DispatcherTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait DispatcherTrait
{

    /**
     * Beautifier function to be called instead of the laravel function dispatchFromArray.
     * To dispatch a command with data.
     *
     * @param $command
     * @param $arguments
     *
     * @return mixed
     */
    public function call($command, array $arguments = [])
    {
        return app('Illuminate\Contracts\Bus\Dispatcher')->dispatchFromArray($command, $arguments);
    }
}
