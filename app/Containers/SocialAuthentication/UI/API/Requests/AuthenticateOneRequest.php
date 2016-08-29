<?php

namespace App\Containers\SocialAuthentication\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class AuthenticateOneRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AuthenticateOneRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oauth_token'     => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
