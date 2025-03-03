<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\GivePermissionsToRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class GivePermissionsToRoleController extends ApiController
{
    public function __invoke(GivePermissionsToRoleRequest $request, GivePermissionsToRoleAction $action): JsonResponse
    {
        $role = $action->run($request->role_id, ...$request->permission_ids);

        return Response::create($role, RoleAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->ok();
    }
}
