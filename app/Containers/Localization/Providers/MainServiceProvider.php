<?php

namespace App\Containers\Localization\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Carbon\Laravel\ServiceProvider as LaravelCarbonServiceProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MainServiceProvider extends MainProvider
{

    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
        MiddlewareServiceProvider::class,
        LaravelCarbonServiceProvider::class,
    ];

    /**
     * Container Aliases
     */
    public array $aliases = [

    ];
}
