<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class DeleteUserController extends ApiController
{
    public function __invoke(DeleteUserRequest $request, DeleteUserAction $action): JsonResponse
    {
        $action->run($request->user_id);

        return Response::noContent();
    }
}
