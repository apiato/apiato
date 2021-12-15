<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [

    ];

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
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
        return $this->check([
            'hasAccess',
        ]);
    }
}
