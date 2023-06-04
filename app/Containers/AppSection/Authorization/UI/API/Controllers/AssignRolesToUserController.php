<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AssignRolesToUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class AssignRolesToUserController extends ApiController
{
    public function __construct(
        private readonly AssignRolesToUserAction $assignRolesToUserAction
    ) {
    }

    public function __invoke(AssignRolesToUserRequest $request): array
    {
        $user = $this->assignRolesToUserAction->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
