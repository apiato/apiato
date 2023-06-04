<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use App\Ship\Parents\Requests\Request;

class CreatePermissionAction extends ParentAction
{
    public function __construct(
        private readonly CreatePermissionTask $createPermissionTask
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(Request $request): Permission
    {
        return $this->createPermissionTask->run($request->name, $request->description, $request->display_name);
    }
}
