<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\GetRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class GetRolePermissionsController extends ApiController
{
    /**
     * @param GetRolePermissionsRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function getRolePermissions(GetRolePermissionsRequest $request): array
    {
        $permission = app(GetRolePermissionsAction::class)->run($request);

        return $this->transform($permission, PermissionTransformer::class);
    }
}
