<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class DetachPermissionsFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleAction extends Action
{
    /**
     * @param $roleId
     * @param $permissionsIds
     *
     * @return  mixed
     */
    public function run($roleId, $permissionsIds)
    {
        $role = $this->call(GetRoleTask::class, [$roleId]);

        return $this->call(DetachPermissionsFromRoleTask::class, [$role, $permissionsIds]);
    }
}
