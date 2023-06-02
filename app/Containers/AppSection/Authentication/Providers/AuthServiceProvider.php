<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Ship\Parents\Providers\AuthServiceProvider as ParentAuthProvider;
use Carbon\Carbon;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ParentAuthProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     */
    protected bool $defer = true;

    /**
     * The policy mappings for the application.
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        parent::boot();

        $this->registerPassport();
    }

    private function registerPassport(): void
    {
        if (config('apiato.api.enabled-implicit-grant')) {
            Passport::enableImplicitGrant();
        }

        Passport::tokensExpireIn(Carbon::now()->addMinutes(config('apiato.api.expires-in')));

        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(config('apiato.api.refresh-expires-in')));
    }

    public function register(): void
    {
        parent::register();

        Passport::ignoreRoutes();
    }
}
