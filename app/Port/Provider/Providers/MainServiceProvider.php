<?php

namespace App\Port\Provider\Providers;

use App\Port\Butler\Portals\PortButler;
use App\Port\Provider\Abstracts\ServiceProviderAbstract;
use App\Port\Provider\Traits\PortServiceProviderTrait;
use App\Port\Routes\Providers\RoutesServiceProvider;
use Barryvdh\Cors\ServiceProvider as CorsServiceProvider;
use Brotzka\DotenvEditor\DotenvEditorFacade;
use Brotzka\DotenvEditor\DotenvEditorServiceProvider;
use Dingo\Api\Provider\LaravelServiceProvider as DingoApiServiceProvider;
use Jenssegers\Agent\AgentServiceProvider;
use Jenssegers\Agent\Facades\Agent;
use Laravel\Socialite\SocialiteServiceProvider;
use Prettus\Repository\Providers\RepositoryServiceProvider;

/**
 * Class MainServiceProvider
 * The main Service Provider where all Service Providers gets registered
 * this is the only Service Provider that gets injected in the Config/app.php.
 *
 * A.K.A app/Providers/AppServiceProvider.php
 *
 * Class PortServiceProvider
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MainServiceProvider extends ServiceProviderAbstract
{

    use PortServiceProviderTrait;

    /**
     * the new Models Factories Paths
     */
    const MODELS_FACTORY_PATH = '/app/Port/Factory';

    /**
     * Port Service Providers
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
     * Port Aliases
     *
     * @var  array
     */
    private $aliases = [
        'Agent'        => Agent::class,
        'DotenvEditor' => DotenvEditorFacade::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerServiceProviders(array_merge($this->getMainServiceProviders(), $this->serviceProviders));
        $this->autoMigrationsFromContainers();
        $this->autoLoadViewsFromContainers();
        $this->overrideDefaultFractalSerializer();
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind('PortButler', function () {
            return $this->app->make(PortButler::class);
        });
        $this->registerAliases($this->aliases);
        $this->changeTheDefaultDatabaseModelsFactoriesPath(self::MODELS_FACTORY_PATH);
        $this->debugDatabaseQueries(true, true);
    }

}
