<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class EmailVerificationServiceProvider extends ParentServiceProvider
{
    public function boot(): void
    {
        // TODO: needs more test
        VerifyEmail::createUrlUsing(static function (User $notifiable) {
            $clientType = request()->header('Client-Type', 'web');

            $frontendUrls = Config::get('apiato.frontend.urls', []);
            $frontendUrl = $frontendUrls[$clientType] ?? $frontendUrls['web'];

            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getHashedKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ],
            );

            return "{$frontendUrl}?verification_url=" . $verificationUrl;
        });
    }
}
