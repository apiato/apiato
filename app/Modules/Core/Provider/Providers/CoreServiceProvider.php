<?php

namespace Hello\Modules\Core\Provider\Providers;

use Hello\Modules\Core\Provider\Abstracts\ServiceProvider;

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
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerServiceProviders($this->getModulesServiceProviders());
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
