<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\AssignRolesToUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class AssignRolesToUserController extends ApiController
{
    /**
     * @param AssignRolesToUserRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function assignRolesToUser(AssignRolesToUserRequest $request): array
    {
        $user = app(AssignRolesToUserAction::class)->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
