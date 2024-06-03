<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\UpdatePasswordAction;
use App\Containers\AppSection\User\UI\API\Requests\UpdatePasswordRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use Apiato\Core\Facades\Response;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class UpdatePasswordController extends ApiController
{
    public function __invoke(UpdatePasswordRequest $request, UpdatePasswordAction $action): JsonResponse
    {
        $user = $action->run($request);

        return Response::createFrom($user)->transformWith(UserTransformer::class)->ok();
    }
}
