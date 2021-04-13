<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\App;

class FindPermissionAction extends Action
{
    public function run(FindPermissionRequest $request): Permission
    {
        $permission = App::make(FindPermissionTask::class)->run($request->id);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }
}
