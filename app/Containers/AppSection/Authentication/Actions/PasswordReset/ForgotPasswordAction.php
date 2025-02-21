<?php

namespace App\Containers\AppSection\Authentication\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ForgotPasswordRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

final class ForgotPasswordAction extends ParentAction
{
    public function run(ForgotPasswordRequest $request): string
    {
        $sanitizedData = $request->sanitize([
            'email',
        ]);

        $status = Password::sendResetLink($sanitizedData);

        return match ($status) {
            Password::RESET_LINK_SENT => __($status),
            Password::RESET_THROTTLED => throw ValidationException::withMessages(['throttle' => __($status)]),
            default => throw ValidationException::withMessages(['email' => __($status)]),
        };
    }
}
