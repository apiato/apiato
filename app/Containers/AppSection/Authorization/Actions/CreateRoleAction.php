<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Ship\Parents\Actions\Action;
use function is_null;

class CreateRoleAction extends Action
{
    public function run(CreateRoleRequest $data): Role
    {
        $level = is_null($data->level) ? 0 : $data->level;

        return Apiato::call(CreateRoleTask::class,
            [$data->name, $data->description, $data->display_name, $level]
        );
    }
}
