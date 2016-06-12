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
     * Extra Core Service Providers.
     *
     * @var array
     */
    private $extraCoreServiceProviders = [
        RoutesServiceProvider::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerServiceProviders(array_merge(
                $this->extraCoreServiceProviders,
                $this->getModulesServiceProviders())
        );

        $this->overrideDefaultFractalSerializer();
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->changeTheDefaultDatabaseModelsFactoriesPath();
        $this->publishModulesMigrationsFiles();
        $this->debugDatabaseQueries(true);
    }
}
