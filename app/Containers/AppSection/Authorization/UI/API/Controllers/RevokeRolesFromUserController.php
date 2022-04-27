<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\RevokeRolesFromUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolesFromUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class RevokeRolesFromUserController extends ApiController
{
    /**
     * @param RevokeRolesFromUserRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function revokeRolesFromUser(RevokeRolesFromUserRequest $request): array
    {
        $user = app(RevokeRolesFromUserAction::class)->run($request);

        return $this->transform($user, UserTransformer::class, ['roles']);
    }
}
