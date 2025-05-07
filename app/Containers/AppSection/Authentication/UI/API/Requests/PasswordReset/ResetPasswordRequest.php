<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset;

use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rules\Password;

final class ResetPasswordRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => [...Password::required(), 'confirmed'],
        ];
    }
}
