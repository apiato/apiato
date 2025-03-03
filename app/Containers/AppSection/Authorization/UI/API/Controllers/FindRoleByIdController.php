<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\FindRoleByIdAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleByIdRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class FindRoleByIdController extends ApiController
{
    public function __invoke(FindRoleByIdRequest $request, FindRoleByIdAction $action): JsonResponse
    {
        $role = $action->run($request->role_id);

        return Response::create($role, RoleAdminTransformer::class)->ok();
    }
}
