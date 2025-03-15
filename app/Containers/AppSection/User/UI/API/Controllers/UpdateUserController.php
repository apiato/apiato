<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class UpdateUserController extends ApiController
{
    public function __invoke(UpdateUserRequest $request, UpdateUserAction $action): JsonResponse
    {
        $user = $action->run(
            $request->user_id,
            $request->sanitize([
                'name',
                'gender',
                'birth',
                'password' => $request->new_password,
            ]),
        );

        return Response::create($user, UserTransformer::class)->ok();
    }
}
