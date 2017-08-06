<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\MainProvider;

/**
 * Class ServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ServiceProvider extends MainProvider
{

    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     *
     * @var array
     */
    public $serviceProviders = [
        //...
    ];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     *
     * @var  array
     */
    protected $aliases = [
        //...
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ...
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // ...
    }

}
