<?php

namespace App\Containers\Authorization\Actions;

<<<<<<< HEAD
use App\Containers\Authorization\Tasks\DeleteRoleTask;
use App\Containers\Authorization\Tasks\FindRoleTask;
=======
>>>>>>> apiato
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

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
<<<<<<< HEAD
        $role = $this->call(FindRoleTask::class, [$request->id]);
        $this->call(DeleteRoleTask::class, [$role]);
=======
        $role = Apiato::call('Authorization@GetRoleTask', [$request->id]);
        Apiato::call('Authorization@DeleteRoleTask', [$role]);
>>>>>>> apiato

        return $role;
    }
}
