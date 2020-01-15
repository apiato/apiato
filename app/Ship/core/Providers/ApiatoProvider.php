<?php

namespace Apiato\Core\Providers;

use Apiato\Core\Abstracts\Events\Providers\EventServiceProvider;
use Apiato\Core\Abstracts\Providers\MainProvider as AbstractMainProvider;
use Apiato\Core\Foundation\Apiato;
use Apiato\Core\Generator\GeneratorsServiceProvider;
use Apiato\Core\Loaders\AutoLoaderTrait;
use Apiato\Core\Loaders\FactoriesLoaderTrait;
use Apiato\Core\Traits\ValidationTrait;
use App\Ship\Parents\Providers\RoutesProvider;
use App\Ship\Providers\ShipProvider;
use Barryvdh\Cors\ServiceProvider as CorsServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Laravel\Tinker\TinkerServiceProvider;
use Optimus\Heimdal\Provider\LaravelServiceProvider as HeimdalExceptionsServiceProvider;
use Prettus\Repository\Providers\RepositoryServiceProvider;
use Spatie\Fractal\FractalFacade;
use Spatie\Fractal\FractalServiceProvider;
use Vinkla\Hashids\Facades\Hashids;
use Vinkla\Hashids\HashidsServiceProvider;

/**
 * Class ApiatoProviders
 *
 * Does not have to extend from the Ship parent MainProvider since it's on the Core
 * it directly extends from the Abstract MainProvider.
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ApiatoProvider extends AbstractMainProvider
{

    use FactoriesLoaderTrait;
    use AutoLoaderTrait;
    use ValidationTrait;

    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     *
     * @var array
     */
    public $serviceProviders = [
        // Third Party Packages Providers:
        HashidsServiceProvider::class,
        RepositoryServiceProvider::class,
        CorsServiceProvider::class,
        FractalServiceProvider::class,
        HeimdalExceptionsServiceProvider::class,

        // add the Laravel Tinker Service Provider
        TinkerServiceProvider::class,

        // Internal Apiato Providers:
        RoutesProvider::class, // exceptionally adding the Route Provider, unlike all other providers in the parents.
        ShipProvider::class, // the ShipProvider for the Ship third party packages.
        GeneratorsServiceProvider::class, // the code generator provider.
    ];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     *
     * @var  array
     */
    protected $aliases = [
        'Hashids' => Hashids::class,
        'Fractal' => FractalFacade::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Autoload most of the Containers and Ship Components
        $this->runLoadersBoot();

        // load all service providers defined in this class
        parent::boot();

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
        parent::register();

        $this->overrideLaravelBaseProviders();

        // Register Core Facade Classes, should not be registered in the alias property above, since they are used
        // by the auto-loading scripts, before the $aliases property is executed.
        $this->app->alias(Apiato::class, 'Apiato');
    }

    /**
     * Register Overided Base providers
     *
     * @see \Illuminate\Foundation\Application::registerBaseServiceProviders
     * @return void
     */
    private function overrideLaravelBaseProviders()
    {
        App::register(EventServiceProvider::class); //The custom apiato eventserviceprovider
    }

}
