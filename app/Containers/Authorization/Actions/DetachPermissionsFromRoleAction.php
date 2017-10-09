<?php

namespace App\Containers\Authorization\Actions;

<<<<<<< HEAD
use App\Containers\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\Authorization\Tasks\FindRoleTask;
=======
>>>>>>> apiato
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

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
<<<<<<< HEAD
        $role = $this->call(FindRoleTask::class, [$request->role_id]);
=======
        $role = Apiato::call('Authorization@GetRoleTask', [$request->role_id]);
>>>>>>> apiato

        return Apiato::call('Authorization@DetachPermissionsFromRoleTask', [$role, $request->permissions_ids]);
    }
}
