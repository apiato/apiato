<?php

namespace App\Containers\AppSection\User\Providers;

use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use Illuminate\Validation\Rules\Password;

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

    public function boot(): void
    {
        parent::boot();

        Password::defaults(static fn () => Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols());
    }

    public function register(): void
    {
        parent::register();
    }
}
