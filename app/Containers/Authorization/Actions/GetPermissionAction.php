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
     * @var  \App\Containers\Authorization\Tasks\GetPermissionTask
     */
    private $getPermissionTask;

    /**
     * GetPermissionAction constructor.
     *
     * @param \App\Containers\Authorization\Tasks\GetPermissionTask $getPermissionTask
     */
    public function __construct(GetPermissionTask $getPermissionTask)
    {
        $this->getPermissionTask = $getPermissionTask;
    }

    /**
     * @param $permissionName
     *
     * @return  mixed
     * @throws \App\Containers\Authorization\Exceptions\PermissionNotFoundException
     */
    public function run($permissionName)
    {
        $permission = $this->getPermissionTask->run($permissionName);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }

}
