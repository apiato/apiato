<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\User\Actions\GetUserProfileAction;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Facades\Fractal;

class GetUserProfileController extends ApiController
{
    public function __invoke(GetUserProfileAction $action): JsonResponse
    {
        $user = $action->run();

        return Fractal::create($user, UserTransformer::class)->ok();
    }
}
