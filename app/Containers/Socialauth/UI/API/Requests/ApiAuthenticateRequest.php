<?php

namespace App\Containers\SocialAuth\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class ApiAuthenticateRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiAuthenticateRequest extends Request
{


    /**
     * Define which Roles and/or Permissions has access to this request..
     *
     * @var  array
     */
    protected $access = [
        'permissions' => null
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [

    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

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
