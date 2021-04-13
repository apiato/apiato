<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Ship\Parents\Actions\Action;

class CreateRoleAction extends Action
{
    public function run(CreateRoleRequest $request): Role
    {
        $level = is_null($request->level) ? 0 : $request->level;

        return app(CreateRoleTask::class)->run($request->name, $request->description, $request->display_name, $level);
    }
}
