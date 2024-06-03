<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\RemoveUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RemoveUserRolesRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use Apiato\Core\Facades\Response;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class RemoveUserRolesController extends ApiController
{
    public function __invoke(RemoveUserRolesRequest $request, RemoveUserRolesAction $action): JsonResponse
    {
        $user = $action->run($request);

        return Response::createFrom($user)
            ->transformWith(UserAdminTransformer::class)
            ->parseIncludes(['roles'])
            ->ok();
    }
}
