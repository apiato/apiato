<?php

namespace Hello\Modules\Core\Providers;

use Hello\Modules\Core\Providers\Abstracts\ServiceProvider;
use Hello\Services\Configuration\Providers\ModulesConfigServiceProvider;

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
        // TODO: remove this line and load the services providers from the config file. make sure it's loaded befoer the others things
        $this->registerServiceProviders([ModulesConfigServiceProvider::class]);

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
