<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    protected array $decode = [];

    protected array $urlParameters = [];

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::default(),
            ],
            'name' => 'min:2|max:50',
            'gender' => 'in:male,female,unspecified',
            'birth' => 'date',
            'verification_url' => [
                'url',
                Rule::requiredIf(function () {
                    return config('appSection-authentication.require_email_verification');
                }),
                Rule::in(config('appSection-authentication.allowed-verify-email-urls')),
            ],
        ];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
