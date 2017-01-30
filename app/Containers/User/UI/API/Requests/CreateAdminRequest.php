<?php

namespace App\Containers\User\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class CreateAdminRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'email'    => 'required|email|max:40|unique:users,email',
            'password' => 'required|min:3|max:30',
            'name'     => 'min:2|max:50',
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->user()->hasRole('admin');
    }
}
