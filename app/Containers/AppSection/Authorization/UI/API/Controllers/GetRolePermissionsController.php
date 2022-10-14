<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GetRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetRolePermissionsController extends ApiController
{
    /**
     * @param GetRolePermissionsRequest $request
     * @return mixed
     * @throws \Apiato\Core\Exceptions\CoreInternalErrorException
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getRolePermissions(GetRolePermissionsRequest $request)
    {
        $permission = app(GetRolePermissionsAction::class)->run($request);
        return $this->transform($permission, PermissionTransformer::class);
    }
}
