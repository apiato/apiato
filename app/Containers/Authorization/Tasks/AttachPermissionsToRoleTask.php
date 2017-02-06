<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Actions\GetRoleAction;
use App\Port\Task\Abstracts\Task;

/**
 * Class AttachPermissionsToRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleTask extends Task
{

    /**
     * @var  \App\Containers\Authorization\Actions\GetRoleAction
     */
    private $getRoleAction;


    /**
     * AttachPermissionsToRoleTask constructor.
     *
     * @param \App\Containers\Authorization\Actions\GetRoleAction $getRoleAction
     */
    public function __construct(GetRoleAction $getRoleAction)
    {
        $this->getRoleAction = $getRoleAction;
    }

    /**
     * @param $roleName
     * @param $permissionNames
     *
     * @return  mixed
     */
    public function run($roleName, $permissionNames)
    {
        $role = $this->getRoleAction->run($roleName);

        if (is_array($permissionNames)) {

            foreach ($permissionNames as $permissionName) {
                $role->givePermissionTo($permissionName);
            }

        } else {
            $role->givePermissionTo($permissionNames);
        }

        return $role;
    }
}
