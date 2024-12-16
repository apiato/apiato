<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindUserByIdController extends ApiController
{
    public function __invoke(FindUserByIdRequest $request, FindUserByIdAction $action): array
    {
        $user = $action->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
