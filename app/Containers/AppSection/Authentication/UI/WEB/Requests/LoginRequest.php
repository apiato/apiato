<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Requests;

use App\Containers\AppSection\Authentication\Classes\LoginCustomAttribute;
use App\Ship\Parents\Requests\Request as ParentRequest;

class LoginRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    protected array $decode = [
    ];

    protected array $urlParameters = [
    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'password' => 'required|min:3|max:30',
        ];

        return LoginCustomAttribute::mergeValidationRules($rules);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
