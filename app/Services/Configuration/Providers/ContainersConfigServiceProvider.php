<?php

namespace App\Services\Configuration\Providers;

use App\Containers\Core\Provider\Abstracts\ServiceProvider;

/**
 * Class ContainersConfigServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ContainersConfigServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind('modulesConfigReaderService', function () {
            return $this->app->make('App\Services\Configuration\Portals\ContainersConfigReaderService');
        });
    }
}
