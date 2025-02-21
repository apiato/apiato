<?php

namespace App\Containers\AppSection\Authentication\Actions\EmailVerification;

use App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification\VerifyRequest;
use App\Ship\Exceptions\ResourceNotFound;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Auth\Events\Verified;

final class VerifyAction extends ParentAction
{
    /**
     * @throws ResourceNotFound
     * @throws \Throwable
     */
    public function run(VerifyRequest $request): void
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->markEmailAsVerified();

            event(new Verified($request->user()));
        }
    }
}
