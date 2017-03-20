<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\Authorization\Tasks\GetPermissionTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetPermissionAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetPermissionAction extends Action
{

    /**
     * @param $permissionName
     *
     * @return  mixed
     */
    public function run($permissionName)
    {
        $permission = $this->call(GetPermissionTask::class, [$permissionName]);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }

}
