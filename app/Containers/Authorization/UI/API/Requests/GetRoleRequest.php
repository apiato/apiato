<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class GetRoleRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetRoleRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'name' => 'required|exists:roles,name'
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
