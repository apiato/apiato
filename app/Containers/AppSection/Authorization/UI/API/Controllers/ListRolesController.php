<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\ListRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

final class ListRolesController extends ApiController
{
    public function __invoke(ListRolesRequest $request, ListRolesAction $action): array
    {
        $roles = $action->run();

        return Response::create($roles, RoleAdminTransformer::class)->toArray();
    }
}
