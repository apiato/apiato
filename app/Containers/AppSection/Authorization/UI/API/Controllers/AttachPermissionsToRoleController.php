<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\AttachPermissionsToRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionsToRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class AttachPermissionsToRoleController extends ApiController
{
    public function __construct(
        private readonly AttachPermissionsToRoleAction $attachPermissionsToRoleAction
    ) {
    }

    /**
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function __invoke(AttachPermissionsToRoleRequest $request): array
    {
        $role = $this->attachPermissionsToRoleAction->run($request);

        return $this->transform($role, RoleTransformer::class);
    }
}
