<?php

namespace App\Containers\Authentication\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class UserLoginRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserLoginRequest extends Request
{

    /**
     * The required Permissions to proceed with this request.
     *
     * @var  array
     */
    protected $access = [
        'permission' => null
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [

    ];

    /**
     * URL parameters (`/stores/999/items`) that needs to apply validation rules on.
     *
     * @var  array
     */
    protected $applyRulesOn = [

    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|email|max:40',
            'password' => 'required|max:30',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->hasAccess();
    }
}
