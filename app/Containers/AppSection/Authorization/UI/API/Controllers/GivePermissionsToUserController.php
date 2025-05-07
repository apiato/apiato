<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\GivePermissionsToUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class GivePermissionsToUserController extends ApiController
{
    public function __invoke(GivePermissionsToUserRequest $request, GivePermissionsToUserAction $action): JsonResponse
    {
        $user = $action->run($request->user_id, ...$request->permission_ids);

        return Response::create($user, UserAdminTransformer::class)
            ->parseIncludes(['permissions'])
            ->ok();
    }
}
