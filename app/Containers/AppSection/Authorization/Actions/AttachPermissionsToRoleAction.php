<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionsToRoleRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class AttachPermissionsToRoleAction extends ParentAction
{
    /**
     * @param AttachPermissionsToRoleRequest $request
     * @return Role
     * @throws NotFoundException
     */
    public function run(AttachPermissionsToRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->role_id);

        $permissionIds = (array)$request->permissions_ids;

        $permissions = array_map(static function ($permissionId) {
            return app(FindPermissionTask::class)->run($permissionId);
        }, $permissionIds);

        return $role->givePermissionTo($permissions);
    }
}
