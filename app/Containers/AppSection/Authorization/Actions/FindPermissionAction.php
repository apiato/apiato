<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindPermissionAction extends ParentAction
{
    /**
     * @param FindPermissionRequest $request
     * @return Permission
     * @throws NotFoundException
     */
    public function run(FindPermissionRequest $request): Permission
    {
        return app(FindPermissionTask::class)->run($request->id);
    }
}
