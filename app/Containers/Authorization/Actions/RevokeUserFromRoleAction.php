<?php

namespace App\Containers\Authorization\Actions;

<<<<<<< HEAD
use App\Containers\Authorization\Tasks\FindRoleTask;
=======
>>>>>>> apiato
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Database\Eloquent\Collection;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class RevokeUserFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        if (!$request->user_id instanceof User) {
            $user = Apiato::call('User@FindUserByIdTask', [$request->user_id]);
        }

        if (!is_array($rolesIds = $request->roles_ids)) {
            $rolesIds = [$rolesIds];
        }

        $roles = new Collection();

        foreach ($rolesIds as $roleId) {
<<<<<<< HEAD
            $role = $this->call(FindRoleTask::class, [$roleId]);
=======
            $role = Apiato::call('Authorization@GetRoleTask', [$roleId]);
>>>>>>> apiato
            $roles->add($role);
        }

        foreach ($roles->pluck('name')->toArray() as $roleName) {
            $user->removeRole($roleName);
        }

        return $user;
    }
}
