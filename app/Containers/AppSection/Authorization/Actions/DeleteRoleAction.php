<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Tasks\DeleteRoleTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Parents\Actions\Action;
use Spatie\Permission\Contracts\Role;

class DeleteRoleAction extends Action
{
    public function run(DeleteRoleRequest $request): Role
    {
        $role = Apiato::call(FindRoleTask::class, [$request->id]);
        Apiato::call(DeleteRoleTask::class, [$role]);

        return $role;
    }
}
