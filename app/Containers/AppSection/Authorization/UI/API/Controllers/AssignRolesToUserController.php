<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\AssignRolesToUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;

final class AssignRolesToUserController extends ApiController
{
    public function __invoke(AssignRolesToUserRequest $request, AssignRolesToUserAction $action): array
    {
        $user = $action->run($request->user_id, ...$request->role_ids);

        return Response::create($user, UserAdminTransformer::class)->parseIncludes(['roles'])->toArray();
    }
}
