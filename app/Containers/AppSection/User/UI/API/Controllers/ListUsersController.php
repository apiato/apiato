<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\User\Actions\ListUsersAction;
use App\Containers\AppSection\User\UI\API\Requests\ListUsersRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ListUsersController extends ApiController
{
    public function __invoke(ListUsersRequest $request, ListUsersAction $action): JsonResponse
    {
        $users = $action->run();

        return Response::create($users, UserTransformer::class)->ok();
    }
}
