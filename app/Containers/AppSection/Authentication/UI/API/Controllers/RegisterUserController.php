<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class RegisterUserController extends ApiController
{
    public function __invoke(RegisterUserRequest $request, RegisterUserAction $action): array|null
    {
        $user = $action->transactionalRun($request);

        return Fractal::create($user, UserTransformer::class)->toArray();
    }
}
