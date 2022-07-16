<?php

namespace App\Containers\AppSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllRolesTask;
use App\Containers\AppSection\Authorization\Tasks\GetRolePermissionsTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetRolePermissionsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetRolePermissionsAction extends ParentAction
{
    /**
     * @param GetRolePermissionsRequest $request
     * @return mixed
     */

    public function run(GetRolePermissionsRequest $request): mixed
    {
        $role = app(FindRoleTask::class)->run($request->id);
        return $role->permissions;
    }
}
