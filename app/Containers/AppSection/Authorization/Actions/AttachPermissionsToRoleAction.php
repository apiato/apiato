<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Ship\Parents\Actions\Action;

class AttachPermissionsToRoleAction extends Action
{
    public function run(AttachPermissionToRoleRequest $data): Role
    {
        $role = Apiato::call(FindRoleTask::class, [$data->role_id]);

        // convert to array in case single ID was passed
        $permissionIds = (array)$data->permissions_ids;

        $permissions = array_map(static function ($permissionId) {
            return Apiato::call(FindPermissionTask::class, [$permissionId]);
        }, $permissionIds);

        return $role->givePermissionTo($permissions);
    }
}
