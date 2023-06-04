<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindUserByIdController extends ApiController
{
    public function __construct(
        private readonly FindUserByIdAction $findUserByIdAction
    ) {
    }

    public function __invoke(FindUserByIdRequest $request): array
    {
        $user = $this->findUserByIdAction->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
