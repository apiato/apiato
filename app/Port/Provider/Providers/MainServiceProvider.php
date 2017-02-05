<?php

namespace App\Port\Provider\Providers;

use App\Port\Foundation\Portals\PortButler;
use App\Port\Foundation\Providers\FoundationServiceProvider;
use App\Port\Foundation\Traits\FractalTrait;
use App\Port\Foundation\Traits\QueryDebuggerTrait;
use App\Port\Loader\AutoLoaderTrait;
use App\Port\Provider\Abstracts\ServiceProviderAbstract;
use App\Port\Route\Providers\RoutesServiceProvider;
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
    use FractalTrait;
    use AutoLoaderTrait;

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
     * Port Aliases (mainly for third party packages)
     *
     * @var  array
     */
    protected $aliases = [
        'Hashids' => Hashids::class,
    ];

    /**
     * Port Config directories
     *
     * @var array
     */
    protected $portConfigsDirectories = [
        'Config/Configs',
        'Queue/Configs',
        'HashId/Configs',
    ];

    /**
     * Port Migration directories
     *
     * @var  array
     */
    protected $portMigrationsDirectories = [
        'Queue/Data/Migrations',
    ];

    /**
     * Port Console directories
     *
     * @var  array
     */
    protected $portConsolesDirectories = [

    ];


    /**
     * Port Views directories
     *
     * @var  array
     */
    protected $portViewsDirectories = [

    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->bootLoaders();

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

        $this->registerLoaders();
    }

}
