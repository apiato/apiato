<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests;

use App\Containers\AppSection\Authentication\Classes\LoginCustomAttribute;
use App\Ship\Parents\Requests\Request as ParentRequest;

class LoginProxyPasswordGrantRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => '',
        'roles' => '',
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
            // we don't need to require email here. The proper login attribute (with proper validations)
            // will be added automatically by "mergeValidationRules" method below
            // 'email' => 'required',
            'password' => 'required',
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
