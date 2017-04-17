<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\Authorization\Tasks\GetPermissionTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class GetPermissionAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetPermissionAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     * @throws \App\Containers\Authorization\Exceptions\PermissionNotFoundException
     */
    public function run(Request $request)
    {
        $permission = $this->call(GetPermissionTask::class, [$request->id]);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }

}
