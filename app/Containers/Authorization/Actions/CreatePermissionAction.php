<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class CreatePermissionAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePermissionAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  \App\Containers\Authorization\Models\Permission
     */
    public function run(Request $request): Permission
    {
        $permission = Apiato::call('Authorization@CreatePermissionTask',
            [$request->name, $request->description, $request->display_name]
        );

        return $permission;
    }
}
