<?php

namespace App\Containers\AppSection\Authentication\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ResetPasswordController;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Apps\AppFactory;
use App\Ship\Parents\Actions\Action as ParentAction;

final class GenerateUrlAction extends ParentAction
{
    public function __invoke(User $notifiable, string $token): string
    {
        $verificationUrl = action(ResetPasswordController::class, [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return AppFactory::current()->resetPasswordUrl() . '?reset_url=' . $verificationUrl;
    }
}
