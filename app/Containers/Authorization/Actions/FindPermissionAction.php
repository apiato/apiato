<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

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
     * @return Permission
     * @throws \App\Containers\Authorization\Exceptions\PermissionNotFoundException
     */
    public function run(Request $request): Permission
    {
        $permission = Apiato::call('Authorization@FindPermissionTask', [$request->id]);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }

}
