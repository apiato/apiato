<?php

namespace App\Containers\AppSection\Authentication\Actions\EmailVerification;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\URL;

final class GenerateUrlAction extends ParentAction
{
    public function __invoke(User $notifiable): string
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Date::now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getHashedKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ],
        );

        return urlencode(request()->app()->verifyEmailUrl() . '?verification_url=' . $verificationUrl);
    }
}
