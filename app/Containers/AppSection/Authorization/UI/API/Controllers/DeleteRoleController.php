<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DeleteRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class DeleteRoleController extends ApiController
{
    public function __invoke(DeleteRoleRequest $request, DeleteRoleAction $action): JsonResponse
    {
        $action->run($request->role_id);

        return $this->noContent();
    }
}
