<?php

namespace App\Containers\AppSection\Authentication\Actions\EmailVerification;

use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;

final class VerifyAction extends ParentAction
{
    public function run(MustVerifyEmail $user): void
    {
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));
        }
    }
}
