<?php

namespace App\Services\Configuration\Providers;

use App\Modules\Core\Provider\Abstracts\ServiceProvider;

/**
 * Class ModulesConfigServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ModulesConfigServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind('modulesConfigReaderService', function () {
            return $this->app->make('App\Services\Configuration\Portals\ModulesConfigReaderService');
        });
    }
}
