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
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByEmailTask $findUserByEmailTask,
    ) {
    }

    /**
     * @throws InvalidResetPasswordTokenException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(ResetPasswordRequest $request): void
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'token',
            'password',
            'password_confirmation' => $request->password,
        ]);

        $status = Password::broker()->reset(
            $sanitizedData,
            static function ($user, $password) {
                $user->forceFill(compact('password'))
                    ->setRememberToken(Str::random(60));
                $user->save();
            },
        );

        switch ($status) {
            case Password::INVALID_TOKEN:
                throw new InvalidResetPasswordTokenException();
            case Password::INVALID_USER:
                throw new NotFoundException('User Not Found.');
            default:
                $user = $this->findUserByEmailTask->run($sanitizedData['email']);
                $user->notify(new PasswordReset());
        }
    }
}
