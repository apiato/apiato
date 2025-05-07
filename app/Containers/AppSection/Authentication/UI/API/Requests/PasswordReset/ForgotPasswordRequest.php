<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset;

use App\Ship\Parents\Requests\Request as ParentRequest;

final class ForgotPasswordRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
}
