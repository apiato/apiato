<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Requests;

use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Ship\Parents\Requests\Request as ParentRequest;

class LoginRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    protected array $decode = [];

    protected array $urlParameters = [];

    public function rules(): array
    {
        $rules = [
            'password' => 'required',
            'remember' => 'boolean',
        ];

        return LoginFieldProcessor::mergeValidationRules($rules);
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
