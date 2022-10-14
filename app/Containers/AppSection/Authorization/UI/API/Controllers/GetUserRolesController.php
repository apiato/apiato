<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\GetUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetUserRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class GetUserRolesController extends ApiController
{
    /**
     * @param GetUserRolesRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function getUserRoles(GetUserRolesRequest $request): array
    {
        $roles = app(GetUserRolesAction::class)->run($request);

        return $this->transform($roles, RoleTransformer::class);
    }

}
