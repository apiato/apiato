<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\GetAllRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllRolesController extends ApiController
{
    /**
     * @param GetAllRolesRequest $request
     * @return array
     * @throws CoreInternalErrorException
     * @throws InvalidTransformerException
     * @throws RepositoryException
     */
    public function getAllRoles(GetAllRolesRequest $request): array
    {
        $roles = app(GetAllRolesAction::class)->run();

        return $this->transform($roles, RoleTransformer::class);
    }
}
