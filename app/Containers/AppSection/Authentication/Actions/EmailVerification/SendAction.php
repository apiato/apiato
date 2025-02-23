<?php

namespace App\Containers\AppSection\Authentication\Actions\EmailVerification;

use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Auth\MustVerifyEmail;

final class SendAction extends ParentAction
{
    public function run(MustVerifyEmail $user): void
    {
        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }
    }
}
