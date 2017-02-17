<?php

namespace App\Ship\Engine\Providers;

use App\Ship\Engine\Loaders\AutoLoaderTrait;
use App\Ship\Engine\Loaders\FactoriesLoaderTrait;
use App\Ship\Engine\Traits\FractalTrait;
use App\Ship\Features\Validations\ValidationTrait;
use App\Ship\Engine\Butlers\ShipButler;
use App\Ship\Engine\Butlers\LoaderButler;
use App\Ship\Parents\Providers\MainProvider;
use App\Ship\Parents\Providers\RoutesProvider;
use Barryvdh\Cors\ServiceProvider as CorsServiceProvider;
use Dingo\Api\Provider\LaravelServiceProvider as DingoApiServiceProvider;
use Illuminate\Support\Facades\Schema;
use Prettus\Repository\Providers\RepositoryServiceProvider;
use Vinkla\Hashids\Facades\Hashids;
use Vinkla\Hashids\HashidsServiceProvider;

/**
 * The App Service Provider where all Service Providers gets registered
 * this is the only Service Provider that gets injected in the Config/app.php.
 *
 * A.K.A app/Providers/AppServiceProvider.php
 *
 * Class MainServiceProvider
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class PortoServiceProvider extends MainProvider
{

    use FractalTrait;
    use FactoriesLoaderTrait;
    use AutoLoaderTrait;
    use ValidationTrait;

    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     *
     * @var array
     */
    public $serviceProviders = [
        DingoApiServiceProvider::class,
        CorsServiceProvider::class,
        RoutesProvider::class,
        RepositoryServiceProvider::class,
        HashidsServiceProvider::class,
    ];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     *
     * @var  array
     */
    protected $aliases = [
        'Hashids' => Hashids::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Run the Loaders Boot functions
        $this->runLoadersBoot();

        // Change the default Fractal Serializer
        $this->overrideDefaultFractalSerializer();

        // Solves the "specified key was too long" error, introduced in L5.4
        Schema::defaultStringLength(191);

        // Registering custom validation rules
        $this->extendValidationRules();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register Engine Facade Classes
        $this->app->alias(LoaderButler::class, 'LoaderButler');
        $this->app->alias(ShipButler::class, 'ShipButler');

        // Run the Loaders Register functions
        $this->runLoadersRegister();
    }

}
