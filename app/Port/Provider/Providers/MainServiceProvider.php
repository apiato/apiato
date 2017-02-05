<?php

namespace App\Port\Provider\Providers;

use App\Port\Config\Loaders\ConfigsLoaderTrait;
use App\Port\Console\Loaders\ConsolesLoaderTrait;
use App\Port\Factory\Loaders\FactoriesLoaderTrait;
use App\Port\Foundation\Portals\PortButler;
use App\Port\Foundation\Providers\FoundationServiceProvider;
use App\Port\Foundation\Traits\FractalTrait;
use App\Port\Foundation\Traits\QueryDebuggerTrait;
use App\Port\Migration\Loaders\MigrationsLoaderTrait;
use App\Port\Provider\Abstracts\ServiceProviderAbstract;
use App\Port\Provider\Loaders\ProvidersLoaderTrait;
use App\Port\Route\Providers\RoutesServiceProvider;
use App\Port\View\Loaders\ViewsLoaderTrait;
use Barryvdh\Cors\ServiceProvider as CorsServiceProvider;
use Dingo\Api\Provider\LaravelServiceProvider as DingoApiServiceProvider;
use Prettus\Repository\Providers\RepositoryServiceProvider;
use Vinkla\Hashids\Facades\Hashids;
use Vinkla\Hashids\HashidsServiceProvider;

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

    use ConfigsLoaderTrait;
    use MigrationsLoaderTrait;
    use ViewsLoaderTrait;
    use ProvidersLoaderTrait;
    use FactoriesLoaderTrait;
    use ConsolesLoaderTrait;
    use FractalTrait;

    /**
     * Port Service Providers
     *
     * @var array
     */
    private $serviceProviders = [
        FoundationServiceProvider::class,
        DingoApiServiceProvider::class,
        CorsServiceProvider::class,
        RepositoryServiceProvider::class,
        RoutesServiceProvider::class,
        HashidsServiceProvider::class,
    ];

    /**
     * Port Aliases
     *
     * @var  array
     */
    protected $aliases = [
        'Hashids' => Hashids::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->runConfigsAutoLoader();
        $this->runProvidersAutoLoader();
        $this->runMigrationsAutoLoader();
        $this->runViewsAutoLoader();
        $this->runConsolesAutoLoader();

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

        $this->changeTheDefaultFactoriesPath();

        $this->loadPortInternalAliases($this->aliases);
    }

}
