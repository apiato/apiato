<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\AppSection\Authentication\Notifications\PasswordReset;
use App\Containers\AppSection\Authentication\UI\API\Requests\ResetPasswordRequest;
use App\Containers\AppSection\User\Tasks\FindUserByEmailTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByEmailTask $findUserByEmailTask
    ) {
    }

    /**
     * @throws InvalidResetPasswordTokenException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(ResetPasswordRequest $request): mixed
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'token',
            'password',
            'password_confirmation' => $request->password,
        ]);

        $status = Password::broker()->reset(
            $sanitizedData,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        switch ($status) {
            case Password::INVALID_TOKEN:
                throw new InvalidResetPasswordTokenException();
            case Password::INVALID_USER:
                throw new NotFoundException('User Not Found.');
            case Password::PASSWORD_RESET:
                $user = $this->findUserByEmailTask->run($sanitizedData['email']);
                $user->notify(new PasswordReset());

                return $status;
            default:
                throw new UpdateResourceFailedException();
        }
    }
}
