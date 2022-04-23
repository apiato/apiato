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
    /**
     * @param DetachPermissionsFromRoleRequest $request
     * @return Role
     * @throws NotFoundException
     */
    public function run(DetachPermissionsFromRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->role_id);

        $permissions = array_map(static function ($permissionId) {
            return app(FindPermissionTask::class)->run($permissionId);
        }, $request->permissions_ids);

        return app(DetachPermissionsFromRoleTask::class)->run($role, $permissions);
    }
}
