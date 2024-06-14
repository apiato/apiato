<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use Apiato\Core\Facades\Response;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteUserController extends ApiController
{
    public function __invoke(DeleteUserRequest $request, DeleteUserAction $action): JsonResponse
    {
        $action->run($request->getData());

        return Response::noContent();
    }
}
