<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Exceptions\RoleNotFoundException;
<<<<<<< HEAD:app/Containers/Authorization/Actions/FindRoleAction.php
use App\Containers\Authorization\Tasks\FindRoleTask;
=======
>>>>>>> apiato:app/Containers/Authorization/Actions/GetRoleAction.php
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class FindRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     * @throws \App\Containers\Authorization\Exceptions\RoleNotFoundException
     */
    public function run(Request $request)
    {
<<<<<<< HEAD:app/Containers/Authorization/Actions/FindRoleAction.php
        $role = $this->call(FindRoleTask::class, [$roleId = $request->id]);
=======
        $role = Apiato::call('Authorization@GetRoleTask', [$roleId = $request->id]);
>>>>>>> apiato:app/Containers/Authorization/Actions/GetRoleAction.php

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

}
