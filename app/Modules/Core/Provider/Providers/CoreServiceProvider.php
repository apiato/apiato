<?php

namespace App\Modules\Core\Provider\Providers;

use App\Modules\Core\Provider\Abstracts\ServiceProvider;

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
     * the new Models Factories Paths
     */
    const MODELS_FACTORY_PATH = '/app/Modules/Core/Factory';

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
        $this->changeTheDefaultDatabaseModelsFactoriesPath(self::MODELS_FACTORY_PATH);
        $this->publishModulesMigrationsFiles();
        $this->debugDatabaseQueries(true);
    }

}
