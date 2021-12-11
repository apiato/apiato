<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use App\Ship\Parents\Actions\Action;

class VerifyEmailAction extends Action
{
    public function run(VerifyEmailRequest $request): void
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->markEmailAsVerified();

            $request->user()->notify(new EmailVerified());
        }
    }
}
