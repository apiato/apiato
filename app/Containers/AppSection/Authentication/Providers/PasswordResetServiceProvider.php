<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Containers\AppSection\Authentication\Actions\PasswordReset\GenerateUrlAction;
use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

final class PasswordResetServiceProvider extends ParentServiceProvider
{
    public function boot(): void
    {
        ResetPassword::createUrlUsing(new GenerateUrlAction());
    }
}
