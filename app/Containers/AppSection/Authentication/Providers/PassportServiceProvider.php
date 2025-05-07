<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Illuminate\Support\Facades\Date;
use Laravel\Passport\Passport;

final class PassportServiceProvider extends ParentServiceProvider
{
    public function register(): void
    {
        Passport::ignoreRoutes();
    }

    public function boot(): void
    {
        Passport::enablePasswordGrant();
        Passport::tokensExpireIn(Date::now()->addMinutes((int) config('appSection-authentication.tokens-expire-in')));
        Passport::refreshTokensExpireIn(Date::now()->addMinutes((int) config('appSection-authentication.refresh-tokens-expire-in')));
    }
}
