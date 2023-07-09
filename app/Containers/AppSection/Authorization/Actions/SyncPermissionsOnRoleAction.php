<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class SyncPermissionsOnRoleAction extends ParentAction
{
    public function __construct(
        private readonly FindRoleTask $findRoleTask,
        private readonly FindPermissionTask $findPermissionTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(SyncPermissionsOnRoleRequest $request): Role
    {
        $role = $this->findRoleTask->run($request->role_id);

        $permissionsIds = (array) $request->permissions_ids;

        $permissions = array_map(function ($permissionId) {
            return $this->findPermissionTask->run($permissionId);
        }, $permissionsIds);

        $role->syncPermissions($permissions);

        return $role;
    }
}
