<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Mails\UserForgotPasswordMail;
use App\Containers\AppSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\AppSection\User\Tasks\FindUserByEmailTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordAction extends Action
{
    public function run(ForgotPasswordRequest $request): bool
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'reseturl',
        ]);

        // Note: It's a good idea to DON'T say if the user email is valid or not
        // (to avoid brute force checking of user email existing).
        // so we return 'false' if an exception is thrown
        try {
            $user = app(FindUserByEmailTask::class)->run($sanitizedData['email']);
        } catch (Exception) {
            return false;
        }

        $token = app(CreatePasswordResetTokenTask::class)->run($user);

        Mail::send(new UserForgotPasswordMail($user, $token, $sanitizedData['reseturl']));

        return true;
    }
}
