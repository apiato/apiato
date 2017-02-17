<?php

namespace App\Ship\Provider;

use App\Ship\Broadcast\Providers\MainBroadcastServiceProvider;
use App\Ship\Foundation\Shipals\ShipButler;
use App\Ship\Foundation\Traits\FractalTrait;
use App\Ship\Foundation\Traits\QueryDebuggerTrait;
use App\Ship\Loader\AutoLoaderTrait;
use App\Ship\Loader\Helpers\LoaderHelper;
use App\Ship\Loader\Loaders\FactoriesLoaderTrait;
use App\Ship\Policy\Providers\MainAuthServiceProvider;
use App\Ship\Provider\Abstracts\ServiceProviderAbstract;
use App\Ship\Route\Providers\MainRoutesServiceProvider;
use Barryvdh\Cors\ServiceProvider as CorsServiceProvider;
use Dingo\Api\Provider\LaravelServiceProvider as DingoApiServiceProvider;
use Illuminate\Support\Facades\Schema;
use Prettus\Repository\Providers\RepositoryServiceProvider;
use Vinkla\Hashids\Facades\Hashids;
use Vinkla\Hashids\HashidsServiceProvider;

/**
 * The main Service Provider where all Service Providers gets registered
 * this is the only Service Provider that gets injected in the Config/app.php.
 *
 * A.K.A app/Providers/AppServiceProvider.php
 *
 * Class MainServiceProvider
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MainServiceProvider extends ServiceProviderAbstract
{

    use FractalTrait;
    use FactoriesLoaderTrait;
    use AutoLoaderTrait;

    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     *
     * @var array
     */
    public $serviceProviders = [
        DingoApiServiceProvider::class,
        CorsServiceProvider::class,
        RepositoryServiceProvider::class,
        MainRoutesServiceProvider::class,
        MainAuthServiceProvider::class,
        MainBroadcastServiceProvider::class,
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
        $this->bootLoaders();

        $this->overrideDefaultFractalSerializer();

        // solves the "specified key was too long" error, introduced in L5.4
        Schema::defaultStringLength(191);

        $this->extendValidationRules();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias(LoaderHelper::class, 'LoaderHelper');
        $this->app->alias(ShipButler::class, 'ShipButler');

        $this->registerLoaders();
    }

    /**
     * TODO: to be removed from this class and placed in a trait
     *
     * Extend the default Laravel validation rules.
     */
    private function extendValidationRules(){
        \Validator::extend('no_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        }, ['String should not contain space.']);
    }
}
