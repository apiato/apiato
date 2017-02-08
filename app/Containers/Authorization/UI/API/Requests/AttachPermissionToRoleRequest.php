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
     * The required Permissions to proceed with this request.
     *
     * @var  array
     */
    protected $access = [
        'permission' => 'manage-roles-permissions'
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [

    ];

    /**
     * URL parameters (`/stores/999/items`) that needs to apply validation rules on.
     *
     * @var  array
     */
    protected $applyRulesOn = [

    ];

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
        return $this->hasAccess();
    }
}
