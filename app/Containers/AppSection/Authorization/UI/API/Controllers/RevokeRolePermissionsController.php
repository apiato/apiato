<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\RevokeRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class RevokeRolePermissionsController extends ApiController
{
    public function __invoke(RevokeRolePermissionsRequest $request, RevokeRolePermissionsAction $action): JsonResponse
    {
        $role = $action->run($request->role_id, ...$request->permission_ids);

        return Response::create($role, RoleAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->ok();
    }
}
