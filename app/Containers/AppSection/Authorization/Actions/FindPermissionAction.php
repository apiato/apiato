<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindPermissionAction extends ParentAction
{
    public function __construct(
        private readonly FindPermissionTask $findPermissionTask
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(FindPermissionRequest $request): Permission
    {
        return $this->findPermissionTask->run($request->id);
    }
}
