<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Ship\Parents\Providers\AuthServiceProvider as ParentAuthServiceProvider;
use Carbon\Carbon;
use Illuminate\Contracts\Support\DeferrableProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ParentAuthServiceProvider implements DeferrableProvider
{
    protected $policies = [];

    public function boot(): void
    {
        parent::boot();

        $this->configPassport();
    }

    private function configPassport(): void
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
