<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Carbon\Carbon;
use Laravel\Passport\Passport;

class PassportServiceProvider extends ParentServiceProvider
{
    public function register(): void
    {
        Passport::ignoreRoutes();
    }

    public function boot(): void
    {
        Passport::enablePasswordGrant();
        Passport::tokensExpireIn(Carbon::now()->addMinutes((int) config('apiato.api.expires-in')));
        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes((int) config('apiato.api.refresh-expires-in')));
    }
}
