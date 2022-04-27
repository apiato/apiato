<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\DetachPermissionsFromRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class DetachPermissionsFromRoleController extends ApiController
{
    /**
     * @param DetachPermissionsFromRoleRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function detachPermissionFromRole(DetachPermissionsFromRoleRequest $request): array
    {
        $role = app(DetachPermissionsFromRoleAction::class)->run($request);

        return $this->transform($role, RoleTransformer::class);
    }
}
