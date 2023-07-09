<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromRoleRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DetachPermissionsFromRoleAction extends ParentAction
{
    public function __construct(
        private readonly FindRoleTask $findRoleTask,
        private readonly FindPermissionTask $findPermissionTask,
        private readonly DetachPermissionsFromRoleTask $detachPermissionsFromRoleTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(DetachPermissionsFromRoleRequest $request): Role
    {
        $role = $this->findRoleTask->run($request->role_id);

        $permissions = array_map(function ($permissionId) {
            return $this->findPermissionTask->run($permissionId);
        }, $request->permissions_ids);

        return $this->detachPermissionsFromRoleTask->run($role, $permissions);
    }
}
