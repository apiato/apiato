<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Ship\Parents\Actions\Action;

class SyncPermissionsOnRoleAction extends Action
{
    public function run(SyncPermissionsOnRoleRequest $request): Role
    {
        $role = Apiato::call(FindRoleTask::class, [$request->role_id]);

        // convert to array in case single ID was passed
        $permissionsIds = (array)$request->permissions_ids;

        $permissions = array_map(static function ($permissionId) {
            return Apiato::call(FindPermissionTask::class, [$permissionId]);
        }, $permissionsIds);

        $role->syncPermissions($permissions);

        return $role;
    }
}
