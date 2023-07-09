<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use Laravel\Passport\PassportServiceProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends ParentMainServiceProvider
{
    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
        AuthServiceProvider::class,
        MiddlewareServiceProvider::class,
        PassportServiceProvider::class,
    ];

    /**
     * Container Aliases.
     */
    public array $aliases = [
    ];
}
