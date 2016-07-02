<?php

namespace App\Kernel\Butler\Providers;

use App\Kernel\Provider\Abstracts\ServiceProviderAbstract;
use App\Kernel\Butler\Portals\KernelButler;

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
