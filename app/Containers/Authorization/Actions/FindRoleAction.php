<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class FindRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Role
     * @throws  RoleNotFoundException
     */
    public function run(DataTransporter $data): Role
    {
        $role = Apiato::call('Authorization@FindRoleTask', [$data->id]);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

}
