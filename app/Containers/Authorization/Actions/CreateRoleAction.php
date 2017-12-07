<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreateRoleAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateRoleAction extends Action
{

    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     * @param int         $level
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(string $name, string $description = null, string $displayName = null, int $level = 0): Role
    {
        $role = Apiato::call('Authorization@CreateRoleTask', [$name, $description, $displayName, $level]);

        return $role;
    }
}
