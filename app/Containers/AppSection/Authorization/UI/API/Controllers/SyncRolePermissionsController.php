<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\SyncRolePermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncRolePermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

final class SyncRolePermissionsController extends ApiController
{
    public function __invoke(SyncRolePermissionsRequest $request, SyncRolePermissionsAction $action): array
    {
        $role = $action->run($request->role_id, ...$request->permission_ids);

        return Response::create($role, RoleAdminTransformer::class)->parseIncludes(['permissions'])->toArray();
    }
}
