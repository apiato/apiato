<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class DetachPermissionsFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $role = $this->call(GetRoleTask::class, [$request->role_id]);

        return $this->call(DetachPermissionsFromRoleTask::class, [$role, $request->permissions_ids]);
    }
}
