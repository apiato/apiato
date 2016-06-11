<?php

namespace Hello\Modules\Core\Providers;

use Hello\Modules\Core\Providers\Abstracts\ServiceProvider;

/**
 * Class CoreServiceProvider
 * The main Service Provider where all Service Providers gets registered
 * this is the only Service Provider that gets injected in the Config/app.php.
 *
 * Class CoreServiceProvider
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * Application Service Provides.
     *
     * @var array
     */
    private $coreServiceProviders = [
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
