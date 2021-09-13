<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\AppSection\User\UI\API\Requests\ResetPasswordRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordAction extends Action
{
    /**
     * @throws NotFoundException
     * @throws InvalidResetPasswordTokenException
     * @throws UpdateResourceFailedException
     */
    public function run(ResetPasswordRequest $request)
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

        return match ($status) {
            Password::INVALID_TOKEN => throw new InvalidResetPasswordTokenException(),
            Password::INVALID_USER => throw new NotFoundException('User Not Found.'),
            Password::PASSWORD_RESET => $status,
            default => throw new UpdateResourceFailedException()
        };
    }
}
