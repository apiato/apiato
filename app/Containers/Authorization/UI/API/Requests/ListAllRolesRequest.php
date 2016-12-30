<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class ListAllRolesRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllRolesRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {
        return [

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
