<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteUserController extends ApiController
{
    public function __construct(
        private readonly DeleteUserAction $deleteUserAction
    ) {
    }

    public function __invoke(DeleteUserRequest $request): JsonResponse
    {
        $this->deleteUserAction->run($request);

        return $this->noContent();
    }
}
