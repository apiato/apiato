<?php

namespace App\Containers\AppSection\Authentication\Actions\EmailVerification;

use App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification\SendRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Auth\MustVerifyEmail;

final class SendAction extends ParentAction
{
    public function run(SendRequest $request): void
    {
        if ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
        }
    }
}
