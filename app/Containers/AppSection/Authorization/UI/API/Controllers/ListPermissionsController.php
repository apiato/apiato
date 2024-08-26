<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authorization\Actions\ListPermissionsAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class ListPermissionsController extends ApiController
{
    public function __invoke(ListPermissionsRequest $request, ListPermissionsAction $action): array|null
    {
        $permissions = $action->run();

        return Fractal::create($permissions, PermissionAdminTransformer::class)->toArray();
    }
}
