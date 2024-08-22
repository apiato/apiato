<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\User\Actions\ListUsersAction;
use App\Containers\AppSection\User\UI\API\Requests\ListUsersRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ListUsersController extends ApiController
{
    public function __invoke(ListUsersRequest $request, ListUsersAction $action): JsonResponse
    {
        $users = $action->run();

        return Response::createFrom($users)->transformWith(UserTransformer::class)->ok();
    }
}
