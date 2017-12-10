<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class CreatePermissionAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePermissionAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Permission
     */
    public function run(DataTransporter $data): Permission
    {
        $permission = Apiato::call('Authorization@CreatePermissionTask',
            [$data->name, $data->description, $data->display_name]
        );

        return $permission;
    }
}
