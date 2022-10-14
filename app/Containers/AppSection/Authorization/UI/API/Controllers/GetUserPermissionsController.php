<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\GetUserPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class GetUserPermissionsController extends ApiController
{
    /**
     * @param GetUserPermissionsRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function getUserPermissions(GetUserPermissionsRequest $request): array
    {
        $permission = app(GetUserPermissionsAction::class)->run($request);

        return $this->transform($permission, PermissionTransformer::class);
    }
}
