<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;

class DetachPermissionsFromRoleAction extends Action
{
    /**
     * @throws NotFoundException
     */
    public function run(DetachPermissionToRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->role_id);
        $permissions = [];
        foreach ($request->permissions_ids as $id) {
            $permissions[] = app(FindPermissionTask::class)->run($id);
        }

        return app(DetachPermissionsFromRoleTask::class)->run($role, $permissions);
    }
}
