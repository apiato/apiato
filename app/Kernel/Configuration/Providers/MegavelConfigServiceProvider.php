<?php

namespace App\Kernel\Configuration\Providers;

use App\Kernel\Provider\Abstracts\ServiceProviderAbstract;
use App\Kernel\Configuration\Portals\MegavelConfigReaderService;

/**
 * Class MegavelConfigServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MegavelConfigServiceProvider extends ServiceProviderAbstract
{

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind('megavelConfigReaderService', function () {
            return $this->app->make(MegavelConfigReaderService::class);
        });
    }
}
