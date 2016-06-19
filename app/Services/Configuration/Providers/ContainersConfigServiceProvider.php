<?php

namespace App\Services\Configuration\Providers;

use App\Engine\Provider\Abstracts\ServiceProviderAbstract;
use App\Services\Configuration\Portals\ContainersConfigReaderService;

/**
 * Class ContainersConfigServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ContainersConfigServiceProvider extends ServiceProviderAbstract
{

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind('containersConfigReaderService', function () {
            return $this->app->make(ContainersConfigReaderService::class);
        });
    }
}
