<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\GetAuthenticatedUserAction;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAuthenticatedUserController extends ApiController
{
    public function __invoke(GetAuthenticatedUserAction $action): array
    {
        $user = $action->run();

        return $this->transform($user, UserTransformer::class);
    }
}
