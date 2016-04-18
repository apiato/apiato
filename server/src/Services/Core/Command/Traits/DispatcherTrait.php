<?php

namespace Mega\Services\Core\Command\Traits;

/**
 * Class DispatcherTrait
 *
 * @type    Trait
 * @package Mega\Services\Core\Command\Traits
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
    public function call($command, $arguments = [])
    {
        return app('Illuminate\Contracts\Bus\Dispatcher')->dispatchFromArray($command, $arguments);
    }

}
