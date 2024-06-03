<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use Apiato\Core\Facades\Response;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class FindUserByIdController extends ApiController
{
    public function __invoke(FindUserByIdRequest $request, FindUserByIdAction $action): JsonResponse
    {
        $user = $action->run($request);

        return Response::createFrom($user)->transformWith(UserTransformer::class)->ok();
    }
}
