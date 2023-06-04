<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetRolePermissionsRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class GetRolePermissionsAction extends ParentAction
{
    public function __construct(
        private readonly FindRoleTask $findRoleTask
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run(GetRolePermissionsRequest $request): mixed
    {
        $role = $this->findRoleTask->run($request->id);

        return $role->permissions;
    }
}
