<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateRoleAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateRoleAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(Request $request): Role
    {
        $level = $request->has('level') ? $request->level : 0;

        $role = Apiato::call('Authorization@CreateRoleTask',
            [$request->name, $request->description, $request->display_name, $level]
        );

        return $role;
    }
}
