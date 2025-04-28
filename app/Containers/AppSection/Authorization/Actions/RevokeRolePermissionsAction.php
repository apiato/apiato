<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolePermissionsRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class RevokeRolePermissionsAction extends ParentAction
{
    public function __construct(private readonly FindRoleTask $findRoleTask)
    {
    }

    /**
     * @throws NotFoundException
     */
    public function run(RevokeRolePermissionsRequest $request): Role
    {
        $role = $this->findRoleTask->run($request->role_id);

        foreach ($request->permission_ids as $permissionId) {
            $role->revokePermissionTo($permissionId);
        }

        return $role;
    }
}
