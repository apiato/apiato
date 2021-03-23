<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Ship\Parents\Actions\Action;

class FindPermissionAction extends Action
{
    public function run(FindPermissionRequest $data): Permission
    {
        $permission = Apiato::call('Authorization@FindPermissionTask', [$data->id]);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }
}
