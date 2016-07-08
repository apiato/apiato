<?php

namespace App\Port\Butler\Providers;

use App\Port\Provider\Abstracts\ServiceProviderAbstract;
use App\Port\Butler\Portals\PortButler;

/**
 * Class PortButlerServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class PortButlerServiceProvider extends ServiceProviderAbstract
{

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind('PortButler', function () {
            return $this->app->make(PortButler::class);
        });
    }
}
