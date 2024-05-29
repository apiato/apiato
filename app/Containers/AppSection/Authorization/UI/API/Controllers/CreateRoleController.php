<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Facades\Fractal;

class CreateRoleController extends ApiController
{
    public function __invoke(CreateRoleRequest $request, CreateRoleAction $action): JsonResponse
    {
        $role = $action->run($request);

        return $this->created(Fractal::create($role, RoleAdminTransformer::class)->toArray());
    }
}
