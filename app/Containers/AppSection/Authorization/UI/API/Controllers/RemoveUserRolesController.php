<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\RemoveUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RemoveUserRolesRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class RemoveUserRolesController extends ApiController
{
    public function __invoke(RemoveUserRolesRequest $request, RemoveUserRolesAction $action): JsonResponse
    {
        $user = $action->run($request->user_id, ...$request->role_ids);

        return Response::create($user, UserAdminTransformer::class)
            ->parseIncludes(['roles'])
            ->ok();
    }
}
