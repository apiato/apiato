<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\FindPermissionAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindPermissionController extends ApiController
{
    /**
     * @param FindPermissionRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findPermission(FindPermissionRequest $request): array
    {
        $permission = app(FindPermissionAction::class)->run($request);

        return $this->transform($permission, PermissionTransformer::class);
    }
}
