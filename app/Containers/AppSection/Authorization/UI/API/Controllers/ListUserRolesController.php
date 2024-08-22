<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\ListUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ListUserRolesController extends ApiController
{
    public function __invoke(ListUserRolesRequest $request, ListUserRolesAction $action): JsonResponse
    {
        $roles = $action->run($request);

        return Response::createFrom($roles)->transformWith(RoleAdminTransformer::class)->ok();
    }
}
