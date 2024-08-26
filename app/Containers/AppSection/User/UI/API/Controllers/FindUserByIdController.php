<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class FindUserByIdController extends ApiController
{
    public function __invoke(FindUserByIdRequest $request, FindUserByIdAction $action): array|null
    {
        $user = $action->run($request);

        return Fractal::create($user, UserTransformer::class)->toArray();
    }
}
