<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\FindRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindRoleController extends ApiController
{
    /**
     * @param FindRoleRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findRole(FindRoleRequest $request): array
    {
        $role = app(FindRoleAction::class)->run($request);

        return $this->transform($role, RoleTransformer::class);
    }
}
