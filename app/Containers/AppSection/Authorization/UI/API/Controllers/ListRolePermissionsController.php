<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class ListRolePermissionsController extends ApiController
{
    public function __invoke(ListRolePermissionsRequest $request, ListRolePermissionsAction $action): array|null
    {
        $permissions = $action->run($request);

        return Fractal::create($permissions, PermissionAdminTransformer::class)->toArray();
    }
}
