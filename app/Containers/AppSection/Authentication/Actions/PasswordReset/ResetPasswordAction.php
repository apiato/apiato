<?php

namespace App\Containers\AppSection\Authentication\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ResetPasswordRequest;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class ResetPasswordAction extends ParentAction
{
    public function run(ResetPasswordRequest $request): string
    {
        $sanitizedData = $request->sanitize([
            'token',
            'email',
            'password',
            'password_confirmation',
        ]);

        $status = Password::reset(
            $sanitizedData,
            static function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password,
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            },
        );

        return match ($status) {
            Password::PASSWORD_RESET => __($status),
            Password::INVALID_TOKEN => throw ValidationException::withMessages(['token' => __($status)]),
            default => throw ValidationException::withMessages(['email' => __($status)]),
        };
    }
}
