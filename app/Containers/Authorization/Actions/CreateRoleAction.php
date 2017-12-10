<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use function is_null;

/**
 * Class CreateRoleAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(DataTransporter $data): Role
    {
        $level = is_null($data->level) ? 0 : $data->level ;

        $role = Apiato::call('Authorization@CreateRoleTask',
            [$data->name, $data->description, $data->display_name, $level]
        );

        return $role;
    }
}
