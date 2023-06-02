<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class UpdateUserController extends ApiController
{
    public function __construct(
        private readonly UpdateUserAction $updateUserAction
    ) {
    }

    public function __invoke(UpdateUserRequest $request): array
    {
        $user = $this->updateUserAction->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
