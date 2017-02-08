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
     * The required Permissions to proceed with this request.
     *
     * @var  array
     */
    protected $access = [
        'permission' => 'admin-access'
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
        return $this->hasAccess();
    }
}
