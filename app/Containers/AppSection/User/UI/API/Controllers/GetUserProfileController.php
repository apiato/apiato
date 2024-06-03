<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\GetUserProfileAction;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use Apiato\Core\Facades\Response;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class GetUserProfileController extends ApiController
{
    public function __invoke(GetUserProfileAction $action): JsonResponse
    {
        $user = $action->run();

        return Response::createFrom($user)->transformWith(UserTransformer::class)->ok();
    }
}
