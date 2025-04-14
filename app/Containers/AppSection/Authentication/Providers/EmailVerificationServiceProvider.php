<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\GenerateUrlAction;
use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;

final class EmailVerificationServiceProvider extends ParentServiceProvider
{
    public function boot(): void
    {
        VerifyEmail::createUrlUsing(new GenerateUrlAction());
    }
}
