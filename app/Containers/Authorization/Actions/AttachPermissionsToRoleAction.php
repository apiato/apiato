<?php

namespace App\Containers\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class AttachPermissionsToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {

        $role = Apiato::call('Authorization@FindRoleTask', [$request->role_id]);

        $permissions = [];

        if (is_array($permissionsIds = $request->permissions_ids)) {
            foreach ($permissionsIds as $permissionId) {

                $permissions[] = Apiato::call('Authorization@FindPermissionTask', [$permissionId]);
            }
        } else {
            $permissions[] = Apiato::call('Authorization@FindPermissionTask', [$permissionsIds]);

        }

        return $role->givePermissionTo($permissions);
    }
}
