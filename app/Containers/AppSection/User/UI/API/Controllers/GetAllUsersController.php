<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\GetAllUsersAction;
use App\Containers\AppSection\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAllUsersController extends ApiController
{
    public function __construct(
        private readonly GetAllUsersAction $getAllUsersAction
    ) {
    }

    public function __invoke(GetAllUsersRequest $request): array
    {
        $users = $this->getAllUsersAction->run();

        return $this->transform($users, UserTransformer::class);
    }
}
