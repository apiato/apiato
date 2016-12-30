<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class AttachPermissionToRoleRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionToRoleRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'role_name'       => 'required|exists:roles,name',
            'permission_name' => 'required|exists:permissions,name',
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
