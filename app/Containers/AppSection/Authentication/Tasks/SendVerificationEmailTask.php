<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Contracts\MustVerifyEmail;
use App\Ship\Parents\Tasks\Task as ParentTask;

class SendVerificationEmailTask extends ParentTask
{
    public function run(MustVerifyEmail $user, null|string $verificationUrl = null): void
    {
        if ($verificationUrl !== null && config('appSection-authentication.require_email_verification') && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotificationWithVerificationUrl($verificationUrl);
        }
    }
}
