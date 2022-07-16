<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GetUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetUserPermissionsController extends ApiController
{
    /**
     * @param GetUserPermissionsRequest $request
     * @return mixed
     * @throws \Apiato\Core\Exceptions\CoreInternalErrorException
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getUserPermissions(GetUserPermissionsRequest $request)
    {
        $permission = app(GetUserPermissionsAction::class)->run($request);
        return $this->transform($permission, PermissionTransformer::class);
    }
}
