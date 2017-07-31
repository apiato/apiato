<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\DeleteRoleTask;
use App\Containers\Authorization\Tasks\GetRoleTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class DeleteRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $role = $this->call(GetRoleTask::class, [$request->id]);
        $this->call(DeleteRoleTask::class, [$role]);

        return $role;
    }
}
