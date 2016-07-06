<?php

namespace App\Ship\Provider\Providers;

use App\Ship\Provider\Abstracts\ServiceProviderAbstract;
use App\Ship\Provider\Traits\AutoRegisterServiceProvidersTrait;
use App\Ship\Provider\Traits\KernelServiceProviderTrait;
use App\Ship\Routes\Providers\RoutesServiceProvider;

/**
 * Class KernelServiceProvider
 * The main Service Provider where all Service Providers gets registered
 * this is the only Service Provider that gets injected in the Config/app.php.
 *
 * Class KernelServiceProvider
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class KernelServiceProvider extends ServiceProviderAbstract
{

    use KernelServiceProviderTrait;
    use AutoRegisterServiceProvidersTrait;

    /**
     * the new Models Factories Paths
     */
    const MODELS_FACTORY_PATH = '/app/Ship/Factory';

    /**
     * Kernel internal Service Provides.
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
        $this->registerServiceProviders(array_merge(
            $this->getContainersServiceProviders(),
            $this->engineServiceProviders
        ));

        $this->overrideDefaultFractalSerializer();
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->changeTheDefaultDatabaseModelsFactoriesPath(self::MODELS_FACTORY_PATH);
        $this->publishContainersMigrationsFiles();
        $this->debugDatabaseQueries(true, true);
    }

}
