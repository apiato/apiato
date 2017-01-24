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
            'roles_names' => 'required|exists:roles,name',
            'user_id'    => 'required|exists:users,id',
        ];
    }

    public function all()
    {
        $data = parent::all();

        $data['user_id'] = $this->decodeThisId($data['user_id']);

        return $data;
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('manage-roles-permissions');
    }
}
