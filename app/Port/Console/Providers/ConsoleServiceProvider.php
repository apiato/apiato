<?php

namespace App\Port\Console\Providers;

use App\Port\Provider\Abstracts\ServiceProviderAbstract;
use App\Port\Provider\Traits\PortServiceProviderTrait;

/**
 * Class ConsoleServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ConsoleServiceProvider extends ServiceProviderAbstract
{

    use PortServiceProviderTrait;

    /**
     * Auto-loading Container Console Commands
     */
    public function boot()
    {
        // TODO: this function needs to be moved somewhere after refactoring the port layer
        if ($this->app->runningInConsole()) {
            $this->commands($this->getAllContainersConsoleCommandsForAutoLoading());
        }
    }

}
