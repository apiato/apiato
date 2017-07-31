<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class AssignUserToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $user = $this->call(FindUserByIdTask::class, [$request->user_id]);

        // convert roles IDs to array (in case single id passed)
        if (!is_array($rolesIds = $request->roles_ids)) {
            $rolesIds = [$request->roles_ids];
        }

        foreach ($rolesIds as $roleId) {
            $roles[] = $this->call(GetRoleTask::class, [$roleId]);
        }

        return $this->call(AssignUserToRoleTask::class, [$user, $roles]);
    }
}
