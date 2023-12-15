<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\ListUsersAction;
use App\Containers\AppSection\User\UI\API\Requests\ListUsersRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class ListUsersController extends ApiController
{
    public function __construct(
        private readonly ListUsersAction $listUsersAction,
    ) {
    }

    public function __invoke(ListUsersRequest $request): array
    {
        $users = $this->listUsersAction->run();

        return $this->transform($users, UserTransformer::class);
    }
}
