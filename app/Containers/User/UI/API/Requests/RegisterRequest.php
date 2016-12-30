<?php

namespace App\Containers\User\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class RegisterRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'email'    => 'required|email|max:40|unique:users,email',
            'password' => 'required|min:6|max:30',
            'name'     => 'required|min:2|max:50',
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return true;
    }
}
