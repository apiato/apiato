<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DetachPermissionsFromRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;

class DetachPermissionsFromRoleController extends ApiController
{
    public function __construct(
        private readonly DetachPermissionsFromRoleAction $detachPermissionsFromRoleAction
    ) {
    }

    public function __invoke(DetachPermissionsFromRoleRequest $request): array
    {
        $role = $this->detachPermissionsFromRoleAction->run($request);

        return $this->transform($role, RoleTransformer::class);
    }
}
