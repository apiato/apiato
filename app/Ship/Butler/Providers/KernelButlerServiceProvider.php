<?php

namespace App\Ship\Butler\Providers;

use App\Ship\Provider\Abstracts\ServiceProviderAbstract;
use App\Ship\Butler\Portals\KernelButler;

/**
 * Class KernelButlerServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class KernelButlerServiceProvider extends ServiceProviderAbstract
{

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind('KernelButler', function () {
            return $this->app->make(KernelButler::class);
        });
    }
}
