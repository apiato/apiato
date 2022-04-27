<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateRoleController extends ApiController
{
    /**
     * @param CreateRoleRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     */
    public function createRole(CreateRoleRequest $request): JsonResponse
    {
        $role = app(CreateRoleAction::class)->run($request);

        return $this->created($this->transform($role, RoleTransformer::class));
    }
}
