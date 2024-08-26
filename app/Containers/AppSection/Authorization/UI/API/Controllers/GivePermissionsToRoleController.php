<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class GivePermissionsToRoleController extends ApiController
{
    public function __invoke(GivePermissionsToRoleRequest $request, GivePermissionsToRoleAction $action): array|null
    {
        $role = $action->run($request);

        return Fractal::create($role, RoleAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->toArray();
    }
}
