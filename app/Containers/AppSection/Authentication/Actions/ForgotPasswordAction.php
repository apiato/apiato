<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Mails\ForgotPassword;
use App\Containers\AppSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\AppSection\User\Tasks\FindUserByEmailTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByEmailTask $findUserByEmailTask,
        private readonly CreatePasswordResetTokenTask $createPasswordResetTokenTask,
    ) {
    }

    /**
     * @throws IncorrectIdException
     */
    public function run(ForgotPasswordRequest $request): bool
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'reseturl',
        ]);

        // It's a good idea to DON'T say if the user email is valid or not
        // (to avoid brute force checking of user email existing).
        try {
            $user = $this->findUserByEmailTask->run($sanitizedData['email']);
            $token = $this->createPasswordResetTokenTask->run($user);
            Mail::send(new ForgotPassword($user, $token, $sanitizedData['reseturl']));
        } catch (Exception) {
        }

        return true;
    }
}
