<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\SyncRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class SyncRolePermissionsController extends ApiController
{
    public function __invoke(SyncRolePermissionsRequest $request, SyncRolePermissionsAction $action): array|null
    {
        $role = $action->run($request);

        return Fractal::create($role, RoleAdminTransformer::class)->toArray();
    }
}
