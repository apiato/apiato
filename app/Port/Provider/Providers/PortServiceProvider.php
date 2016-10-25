<?php

namespace App\Port\Provider\Providers;

use App\Port\Provider\Abstracts\ServiceProviderAbstract;
use App\Port\Provider\Traits\PortServiceProviderTrait;
use App\Port\Routes\Providers\RoutesServiceProvider;
use Barryvdh\Cors\ServiceProvider as CorsServiceProvider;
use Brotzka\DotenvEditor\DotenvEditorServiceProvider;
use Dingo\Api\Provider\LaravelServiceProvider as DingoApiServiceProvider;
use Jenssegers\Agent\AgentServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider;
use Prettus\Repository\Providers\RepositoryServiceProvider;

/**
 * Class PortServiceProvider
 * The main Service Provider where all Service Providers gets registered
 * this is the only Service Provider that gets injected in the Config/app.php.
 *
 * A.K.A app/Providers/AppServiceProvider.php
 *
 * Class PortServiceProvider
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class PortServiceProvider extends ServiceProviderAbstract
{

    use PortServiceProviderTrait;

    /**
     * the new Models Factories Paths
     */
    const MODELS_FACTORY_PATH = '/app/Port/Factory';

    /**
     * Port internal Service Provides.
     *
     * @var array
     */
    private $serviceProviders = [
        DingoApiServiceProvider::class,
        CorsServiceProvider::class,
        RepositoryServiceProvider::class,
        RoutesServiceProvider::class,
        AgentServiceProvider::class,
        SocialiteServiceProvider::class,
        DotenvEditorServiceProvider::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerServiceProviders(array_merge($this->getMainServiceProviders(), $this->serviceProviders));
        $this->autoLoadViewsFromContainers();
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
