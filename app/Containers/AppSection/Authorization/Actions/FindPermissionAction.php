<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Ship\Parents\Actions\Action;

class FindPermissionAction extends Action
{
    /**
     * @throws PermissionNotFoundException
     */
    public function run(FindPermissionRequest $request): Permission
    {
        $permission = Apiato::call(FindPermissionTask::class, [$request->id]);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }
}
