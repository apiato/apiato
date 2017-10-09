<?php

namespace App\Containers\Authorization\Actions;

<<<<<<< HEAD
use App\Containers\Authorization\Tasks\FindRoleTask;
use App\Containers\User\Tasks\FindUserByIdTask;
=======
>>>>>>> apiato
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class SyncUserRolesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncUserRolesAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $user = Apiato::call('User@FindUserByIdTask', [$request->user_id]);

        // convert roles IDs to array (in case single id passed)
        if (!is_array($rolesIds = $request->roles_ids)) {
            $rolesIds = [$request->roles_ids];
        }

        foreach ($rolesIds as $roleId) {
<<<<<<< HEAD
            $roles[] = $this->call(FindRoleTask::class, [$roleId]);
=======
            $roles[] = Apiato::call('Authorization@GetRoleTask', [$roleId]);
>>>>>>> apiato
        }

        $user->syncRoles($roles);

        return $user;
    }
}
