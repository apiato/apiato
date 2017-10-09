<?php

namespace App\Containers\Authorization\Actions;

<<<<<<< HEAD
use App\Containers\Authorization\Tasks\FindPermissionTask;
use App\Containers\Authorization\Tasks\FindRoleTask;
=======
>>>>>>> apiato
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class SyncPermissionsOnRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncPermissionsOnRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
<<<<<<< HEAD
        $role = $this->call(FindRoleTask::class, [$request->role_id]);
=======
        $role = Apiato::call('Authorization@GetRoleTask', [$request->role_id]);
>>>>>>> apiato
        $permissions = [];

        if (is_array($permissionsIds = $request->permissions_ids)) {
            foreach ($permissionsIds as $permissionId) {
<<<<<<< HEAD
                $permissions[] = $this->call(FindPermissionTask::class, [$permissionId]);
            }
        } else {
            $permissions[] = $this->call(FindPermissionTask::class, [$permissionsIds]);
=======
                $permissions[] = Apiato::call('Authorization@GetPermissionTask', [$permissionId]);
            }
        } else {
            $permissions[] = Apiato::call('Authorization@GetPermissionTask', [$permissionsIds]);
>>>>>>> apiato
        }

        $role->syncPermissions($permissions);

        return $role;
    }
}
