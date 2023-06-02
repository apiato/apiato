<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\UpdateUserPasswordAction;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserPasswordRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class UpdateUserPasswordController extends ApiController
{
    public function __construct(
        private readonly UpdateUserPasswordAction $updateUserPasswordAction
    ) {
    }

    public function __invoke(UpdateUserPasswordRequest $request): array
    {
        $user = $this->updateUserPasswordAction->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
