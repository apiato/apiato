<?php

namespace App\Port\Provider;

use App\Port\Broadcast\Providers\MainBroadcastServiceProvider;
use App\Port\Foundation\Portals\PortButler;
use App\Port\Foundation\Providers\FoundationServiceProvider;
use App\Port\Foundation\Traits\FractalTrait;
use App\Port\Foundation\Traits\QueryDebuggerTrait;
use App\Port\Loader\AutoLoaderTrait;
use App\Port\Loader\Helpers\LoaderHelper;
use App\Port\Loader\Loaders\FactoriesLoaderTrait;
use App\Port\Policy\Providers\MainAuthServiceProvider;
use App\Port\Provider\Abstracts\ServiceProviderAbstract;
use App\Port\Route\Providers\MainRoutesServiceProvider;
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
     * Register any Service Providers on the Port layer (including third party packages).
     *
     * @var array
     */
    public $serviceProviders = [
        FoundationServiceProvider::class,
        DingoApiServiceProvider::class,
        CorsServiceProvider::class,
        RepositoryServiceProvider::class,
        MainRoutesServiceProvider::class,
        MainAuthServiceProvider::class,
        MainBroadcastServiceProvider::class,
        HashidsServiceProvider::class,
    ];

    /**
     * Register any Alias on the Port layer (including third party packages).
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
        $this->app->alias(PortButler::class, 'PortButler');

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
