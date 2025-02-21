<?php

namespace App\Containers\AppSection\Authentication\Actions\EmailVerification;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

final class GenerateVerificationUrlAction extends ParentAction
{
    public function __invoke(User $notifiable): string
    {
        $clientType = request()->header('Client-Type', 'web');

        $frontendUrls = config('apiato.frontend.urls', []);
        $frontendUrl = $frontendUrls[$clientType] ?? $frontendUrls['web'];

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getHashedKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ],
        );

        return "{$frontendUrl}?verification_url=" . $verificationUrl;
    }
}
