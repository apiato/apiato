<?php

namespace App\Containers\Authentication\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Arr;

class ProxyLoginPasswordGrantRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => null,
        'roles' => null,
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

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'password' => 'required|min:3|max:30',
        ];

        $rules = $this->loginAttributeValidationRulesMerger($rules);

        return $rules;
    }

    private function loginAttributeValidationRulesMerger(array $rules): array
    {
        $prefix = config('authentication-container.login.prefix', '');
        $allowedLoginAttributes = config('authentication-container.login.attributes', ['email' => []]);

        if (count($allowedLoginAttributes) === 1) {
            $key = array_key_first($allowedLoginAttributes);
            $optionalValidators = $allowedLoginAttributes[$key];
            $validators = implode('|', $optionalValidators);

            $fieldName = $prefix . $key;

            $rules[$fieldName] = "required:{$fieldName}|exists:users,{$key}|{$validators}";

            return $rules;
        }

        foreach ($allowedLoginAttributes as $key => $optionalValidators) {
            // build all other login fields together
            $otherLoginFields = Arr::except($allowedLoginAttributes, $key);
            $otherLoginFields = array_keys($otherLoginFields);
            $otherLoginFields = preg_filter('/^/', $prefix, $otherLoginFields);
            $otherLoginFields = implode(',', $otherLoginFields);

            $validators = implode('|', $optionalValidators);

            $fieldName = $prefix . $key;

            $rules[$fieldName] = "required_without_all:{$otherLoginFields}|exists:users,{$key}|{$validators}";
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
