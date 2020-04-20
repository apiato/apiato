<?php

namespace App\Containers\Authentication\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Arr;

/**
 * Class LoginRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => null,
        'roles' => null,
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [

    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prefix = config('authentication-container.login.prefix', '');

        $allowedLoginFields = config('authentication-container.login.attributes', ['email' => []]);

        $rules = [
            'password' => 'required|min:3|max:30',
        ];

        foreach ($allowedLoginFields as $key => $optionalValidators)
        {
            // build all other login fields together
            $allOtherLoginFields = Arr::except($allowedLoginFields, $key);
            $allOtherLoginFields = array_keys($allOtherLoginFields);
            $allOtherLoginFields = preg_filter('/^/', $prefix, $allOtherLoginFields);
            $allOtherLoginFields = implode(',', $allOtherLoginFields);

            $validators = implode('|', $optionalValidators);

            $keyname = $prefix . $key;

            $rules = array_merge($rules,
                [
                    $keyname => "required_without_all:{$allOtherLoginFields}|exists:users,{$key}|{$validators}",
                ]);
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
