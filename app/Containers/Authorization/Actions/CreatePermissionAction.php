<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreatePermissionAction extends Action
{
    public function run(DataTransporter $data): Permission
    {
        $permission = Apiato::call('Authorization@CreatePermissionTask',
            [$data->name, $data->description, $data->display_name]
        );

        return $permission;
    }
}
