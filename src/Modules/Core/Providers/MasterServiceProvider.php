<?php

namespace Hello\Modules\Core\Providers;

use Hello\Modules\Core\Providers\Abstracts\ServiceProvider;
use Hello\Modules\Core\Route\Providers\ApiBaseRouteServiceProvider;

/**
 * Class MasterServiceProvider
 * The main Service Provider where all Service Providers gets registered
 * this is the only Service Provider that gets injected in the Config/app.php.
 *
 * Class MasterServiceProvider
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MasterServiceProvider extends ServiceProvider
{
    /**
     * Application Service Provides.
     *
     * @var array
     */
    private $coreServiceProviders = [
        ApiBaseRouteServiceProvider::class,
        RoutesServiceProvider::class
    ];

    public function boot()
    {
        $allServiceProviders = array_merge($this->coreServiceProviders, $this->getModulesServiceProviders());

        foreach ($allServiceProviders as $serviceProvider) {
            $this->app->register($serviceProvider);
        }

        $this->overrideDefaultFractalSerializer();
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->changeTheDefaultDatabaseModelsFactoriesPath();
        $this->debugDatabaseQueries(true);
    }
}
