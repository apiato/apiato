<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Ship\Parents\Actions\Action;

class AttachPermissionsToRoleAction extends Action
{
    public function run(AttachPermissionToRoleRequest $data): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$data->role_id]);

        // convert to array in case single ID was passed
        $permissionIds = (array)$data->permissions_ids;

        $permissions = array_map(function ($permissionId) {
            return Apiato::call('Authorization@FindPermissionTask', [$permissionId]);
        }, $permissionIds);

        $role = $role->givePermissionTo($permissions);

        return $role;
    }
}
