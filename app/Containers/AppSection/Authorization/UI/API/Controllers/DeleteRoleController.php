<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DeleteRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteRoleController extends ApiController
{
    public function __construct(
        private readonly DeleteRoleAction $deleteRoleAction
    ) {
    }

    public function __invoke(DeleteRoleRequest $request): JsonResponse
    {
        $this->deleteRoleAction->run($request);

        return $this->noContent();
    }
}
