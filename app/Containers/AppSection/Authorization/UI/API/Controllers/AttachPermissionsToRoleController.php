<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AttachPermissionsToRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionsToRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

class AttachPermissionsToRoleController extends ApiController
{
    public function __invoke(AttachPermissionsToRoleRequest $request, AttachPermissionsToRoleAction $action): array
    {
        $role = $action->run($request);

        return $this->transform($role, RoleAdminTransformer::class);
    }
}
