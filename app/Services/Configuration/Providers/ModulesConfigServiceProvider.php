<?php

namespace Hello\Services\Configuration\Providers;

use Hello\Modules\Core\Providers\Abstracts\ServiceProvider;

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
            return $this->app->make('Hello\Services\Configuration\Portals\ModulesConfigReaderService');
        });
    }
}
