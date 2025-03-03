<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

final class FindUserByIdController extends ApiController
{
    public function __invoke(FindUserByIdRequest $request, FindUserByIdAction $action): array
    {
        $user = $action->run($request->user_id);

        return Response::create($user, UserTransformer::class)->toArray();
    }
}
