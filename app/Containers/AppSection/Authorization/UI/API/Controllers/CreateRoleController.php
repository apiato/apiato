<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateRoleController extends ApiController
{
    public function __construct(
        private readonly CreateRoleAction $createRoleAction,
    ) {
    }

    public function __invoke(CreateRoleRequest $request): JsonResponse
    {
        $role = $this->createRoleAction->run($request);

        return $this->created($this->transform($role, RoleTransformer::class));
    }
}
