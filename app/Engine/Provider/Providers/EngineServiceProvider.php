<?php

namespace App\Engine\Provider\Providers;

use App\Engine\Provider\Abstracts\ServiceProvider;
use App\Engine\Routes\Providers\RoutesServiceProvider;

/**
 * Class EngineServiceProvider
 * The main Service Provider where all Service Providers gets registered
 * this is the only Service Provider that gets injected in the Config/app.php.
 *
 * Class EngineServiceProvider
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class EngineServiceProvider extends ServiceProvider
{

    /**
     * the new Models Factories Paths
     */
    const MODELS_FACTORY_PATH = '/app/Engine/Factory';

    /**
     * Engine internal Service Provides.
     *
     * @var array
     */
    private $engineServiceProviders = [
        RoutesServiceProvider::class
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerServiceProviders(array_merge($this->getContainersServiceProviders(),
            $this->engineServiceProviders));
        $this->overrideDefaultFractalSerializer();
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->changeTheDefaultDatabaseModelsFactoriesPath(self::MODELS_FACTORY_PATH);
        $this->publishContainersMigrationsFiles();
        $this->debugDatabaseQueries(true);
    }

}
