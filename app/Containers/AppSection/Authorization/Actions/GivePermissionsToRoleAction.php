<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToRoleRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class GivePermissionsToRoleAction extends ParentAction
{
    public function __construct(
        private readonly FindRoleTask $findRoleTask,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(GivePermissionsToRoleRequest $request): Role
    {
        $role = $this->findRoleTask->run($request->role_id);

        foreach ($request->permissions_ids as $permissionId) {
            $role->givePermissionTo($permissionId);
        }

        return $role;
    }
}
