<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Exceptions\InvalidEmailVerificationDataException;
use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Throwable;

class VerifyEmailAction extends ParentAction
{
    /**
     * @param VerifyEmailRequest $request
     * @throws NotFoundException
     * @throws Throwable
     */
    public function run(VerifyEmailRequest $request): void
    {
        $user = app(FindUserByIdTask::class)->run($request->id);

        throw_unless($this->validateData($request, $user), InvalidEmailVerificationDataException::class);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            $user->notify(new EmailVerified());
        }
    }

    /**
     * @param VerifyEmailRequest $request
     * @param User $user
     * @return bool
     */
    private function validateData(VerifyEmailRequest $request, User $user): bool
    {
        return hash_equals((string)$request->hash, sha1($user->getEmailForVerification()));
    }
}
