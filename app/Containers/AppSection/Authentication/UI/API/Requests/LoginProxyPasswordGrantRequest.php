<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests;

use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Ship\Parents\Requests\Request as ParentRequest;

class LoginProxyPasswordGrantRequest extends ParentRequest
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
            // We don't need to require email here.
            // The proper login field (with proper validations)
            // will be added automatically by "mergeValidationRules" method below
            // 'email' => 'required',
            'password' => 'required',
        ];

        return LoginFieldProcessor::mergeValidationRules($rules);
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
