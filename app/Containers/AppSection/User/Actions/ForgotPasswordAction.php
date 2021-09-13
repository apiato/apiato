<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Mails\UserForgotPasswordMail;
use App\Containers\AppSection\User\Tasks\CreatePasswordResetTask;
use App\Containers\AppSection\User\Tasks\FindUserByEmailTask;
use App\Containers\AppSection\User\UI\API\Requests\ForgotPasswordRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordAction extends Action
{
    /**
     * @throws NotFoundException
     */
    public function run(ForgotPasswordRequest $request): bool
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'reseturl',
        ]);

        // Note: It's a good idea to NOT say if the user email is valid
        // (to avoid brute force checking of user email existing).
        // so we return 'false' if an exception is thrown
        try {
            $user = app(FindUserByEmailTask::class)->run($sanitizedData['email']);
        } catch (Exception) {
            return false;
        }

        $token = app(CreatePasswordResetTask::class)->run($user);
        $resetUrl = $sanitizedData['reseturl'];

        if (!$this->endpointIsAllowed($resetUrl)) {
            throw new NotFoundException("The URL is not allowed ($resetUrl)");
        }

        Mail::send(new UserForgotPasswordMail($user, $token, $resetUrl));

        return true;
    }

    private function endpointIsAllowed(string $resetUrl): bool
    {
        return in_array($resetUrl, config('appSection-authentication.allowed-reset-password-urls'), true);
    }
}
