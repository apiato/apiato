<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateRoleController extends ApiController
{
    public function __invoke(CreateRoleRequest $request, CreateRoleAction $action): JsonResponse
    {
        $role = $action->run($request);

        return Response::createFrom($role)->transformWith(RoleAdminTransformer::class)->created();
    }
}
