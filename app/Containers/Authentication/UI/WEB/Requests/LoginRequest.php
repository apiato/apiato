<?php

namespace App\Containers\Authentication\UI\WEB\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class LoginRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginRequest extends Request
{

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
        return true;
    }
}
