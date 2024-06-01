<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use App\Ship\Providers\MacroProviders\ConfigMacroServiceProvider;
use App\Ship\Providers\MacroProviders\FractalMacroServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

class ShipProvider extends ParentMainServiceProvider
{
    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     */
    public array $serviceProviders = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
        ConfigMacroServiceProvider::class,
        FractalMacroServiceProvider::class,
    ];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     */
    protected array $aliases = [];

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
        parent::register();

        /*
         * Load the ide-helper service provider only in non production environments.
         */
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
