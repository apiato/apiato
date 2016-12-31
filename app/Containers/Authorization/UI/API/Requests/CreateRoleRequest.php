<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class CreateRoleRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateRoleRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'name'         => 'required|unique:roles,name|max:100',
            'description'  => 'max:255',
            'display_name' => 'max:100',
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
