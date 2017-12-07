<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreatePermissionAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePermissionAction extends Action
{

    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     *
     * @return  \App\Containers\Authorization\Models\Permission
     */
    public function run(string $name, string $description = null, string $displayName = null): Permission
    {
        $permission = Apiato::call('Authorization@CreatePermissionTask', [$name, $description, $displayName]);

        return $permission;
    }
}
