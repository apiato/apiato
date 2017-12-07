<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Actions\Action;

/**
 * Class FindPermissionAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindPermissionAction extends Action
{

    /**
     * @param $permissionId
     *
     * @return  \App\Containers\Authorization\Models\Permission
     */
    public function run($permissionId): Permission
    {
        $permission = Apiato::call('Authorization@FindPermissionTask', [$permissionId]);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }

}
