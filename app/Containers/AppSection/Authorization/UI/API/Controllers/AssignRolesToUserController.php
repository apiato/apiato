<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AssignRolesToUserAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserAdminTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class AssignRolesToUserController extends ApiController
{
    public function __invoke(AssignRolesToUserRequest $request, AssignRolesToUserAction $action): array|null
    {
        $user = $action->run($request);

        return Fractal::create($user, UserAdminTransformer::class)
            ->parseIncludes(['roles'])
            ->toArray();
    }
}
