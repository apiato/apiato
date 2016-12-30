<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class AssignUserToRoleRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'name' => 'required|exists:roles,name',
            'user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('manage-roles-permissions');
    }
}
