<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Facades\Facade;

class ShipProvider extends MainProvider
{
    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     */
    public array $serviceProviders = [];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     */
    protected array $aliases = [];


    public function __construct()
    {
        parent::__construct(app());

        if (class_exists('Barryvdh\Debugbar\Facade')) {
            $this->aliases['Debugbar'] = Facade::class;
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * Load the ide-helper service provider only in non production environments.
         */
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        parent::register();
    }
}
