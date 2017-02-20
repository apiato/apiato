<?php

namespace App\Ship\Parents\Providers;

use App\Ship\Engine\Loaders\AliasesLoaderTrait;
use App\Ship\Engine\Loaders\ProvidersLoaderTrait;
use Illuminate\Support\ServiceProvider as LaravelAppServiceProvider;

/**
 * Class MainProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class MainProvider extends LaravelAppServiceProvider
{
    use ProvidersLoaderTrait;
    use AliasesLoaderTrait;


    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->loadServiceProviders();
    }

    /**
     * Register anything in the container.
     */
    public function register()
    {
        $this->loadAliases();
    }
}
