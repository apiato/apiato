<?php

namespace App\Containers\AppSection\Authentication\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ResetPasswordController;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;

final class GeneratePasswordResetUrlAction extends ParentAction
{
    public function __invoke(User $notifiable, string $token): string
    {
        $appId = request()->appId();
        $frontendUrls = config("apiato.apps.{$appId}", []);
        $frontendUrl = $frontendUrls['url'];

        $verificationUrl = action(ResetPasswordController::class, [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return "{$frontendUrl}?reset_url=" . $verificationUrl;
    }
}
