<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class ListAllPermissionsRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetPermissionRequest extends Request
{

    /**
     * The required Permissions to proceed with this request.
     *
     * @var  array
     */
    protected $access = [
        'permission' => 'manage-roles-permissions'
    ];


    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'name' => 'required|exists:permissions,name'
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->validatePermission();
    }
}
