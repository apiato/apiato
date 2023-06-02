<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GetAllRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAllRolesController extends ApiController
{
    public function __construct(
        private readonly GetAllRolesAction $getAllRolesAction
    ) {
    }

    public function __invoke(GetAllRolesRequest $request): array
    {
        $roles = $this->getAllRolesAction->run();

        return $this->transform($roles, RoleTransformer::class);
    }
}
