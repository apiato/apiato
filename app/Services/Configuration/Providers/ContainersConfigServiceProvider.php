<?php

namespace App\Services\Configuration\Providers;

use App\Engine\Provider\Abstracts\ServiceProvider;

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
        $this->app->bind('containersConfigReaderService', function () {
            return $this->app->make('App\Services\Configuration\Portals\ContainersConfigReaderService');
        });
    }
}
