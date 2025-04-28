<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Providers;

use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;

/**
 * The Main Service Provider of this container.
 * It will be automatically registered by the framework.
 */
class MainServiceProvider extends ParentMainServiceProvider
{
    public array $serviceProviders = [
        // InternalServiceProviderExample::class,
    ];

    public array $aliases = [
        // 'Foo' => Bar::class,
    ];

    #[\Override]
    public function register(): void
    {
        parent::register();
    }
}
