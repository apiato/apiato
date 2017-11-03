<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Barryvdh\Debugbar\Facade;
use Barryvdh\Debugbar\ServiceProvider;

/**
 * Class ShipProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ShipProvider extends MainProvider
{

    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     *
     * @var array
     */
    public $serviceProviders = [
        ServiceProvider::class,
        // ...
    ];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     *
     * @var  array
     */
    protected $aliases = [
        'Debugbar' => Facade::class,
        // ...
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ...
        parent::boot();
        // ...
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Load the ide-helper service provider only in non production environments.
         */
        if ($this->app->environment() !== 'production')
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

        parent::register();
    }

}
