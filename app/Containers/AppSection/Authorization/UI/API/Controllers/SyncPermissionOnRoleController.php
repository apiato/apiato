<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\SyncPermissionsOnRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class SyncPermissionOnRoleController extends ApiController
{
    /**
     * @param SyncPermissionsOnRoleRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function syncPermissionOnRole(SyncPermissionsOnRoleRequest $request): array
    {
        $role = app(SyncPermissionsOnRoleAction::class)->run($request);

        return $this->transform($role, RoleTransformer::class);
    }
}
