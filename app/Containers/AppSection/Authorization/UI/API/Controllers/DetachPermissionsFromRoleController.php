<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DetachPermissionsFromRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class DetachPermissionsFromRoleController extends ApiController
{
    public function __invoke(DetachPermissionsFromRoleRequest $request, DetachPermissionsFromRoleAction $action): array
    {
        $role = $action->run($request);

        return $this->transform($role, RoleAdminTransformer::class);
    }
}
