<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\ListRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ListRolesController extends ApiController
{
    public function __invoke(ListRolesRequest $request, ListRolesAction $action): JsonResponse
    {
        $roles = $action->run();

        return Response::createFrom($roles)->transformWith(RoleAdminTransformer::class)->ok();
    }
}
