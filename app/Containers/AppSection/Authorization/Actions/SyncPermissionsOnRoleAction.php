<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Ship\Parents\Actions\Action;

class SyncPermissionsOnRoleAction extends Action
{
    public function run(SyncPermissionsOnRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->role_id);

        // convert to array in case single ID was passed
        $permissionsIds = (array)$request->permissions_ids;

        $permissions = array_map(static function ($permissionId) {
            return app(FindPermissionTask::class)->run($permissionId);
        }, $permissionsIds);

        $role->syncPermissions($permissions);

        return $role;
    }
}
