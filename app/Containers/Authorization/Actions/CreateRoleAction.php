<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use function is_null;

class CreateRoleAction extends Action
{
    public function run(DataTransporter $data): Role
    {
        $level = is_null($data->level) ? 0 : $data->level;

        $role = Apiato::call('Authorization@CreateRoleTask',
            [$data->name, $data->description, $data->display_name, $level]
        );

        return $role;
    }
}
