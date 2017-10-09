<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Exceptions\PermissionNotFoundException;
<<<<<<< HEAD:app/Containers/Authorization/Actions/FindPermissionAction.php
use App\Containers\Authorization\Tasks\FindPermissionTask;
=======
>>>>>>> apiato:app/Containers/Authorization/Actions/GetPermissionAction.php
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class FindPermissionAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindPermissionAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     * @throws \App\Containers\Authorization\Exceptions\PermissionNotFoundException
     */
    public function run(Request $request)
    {
<<<<<<< HEAD:app/Containers/Authorization/Actions/FindPermissionAction.php
        $permission = $this->call(FindPermissionTask::class, [$request->id]);
=======
        $permission = Apiato::call('Authorization@GetPermissionTask', [$request->id]);
>>>>>>> apiato:app/Containers/Authorization/Actions/GetPermissionAction.php

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }

}
