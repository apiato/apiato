<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\UpdatePasswordAction;
use App\Containers\AppSection\User\UI\API\Requests\UpdatePasswordRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Spatie\Fractal\Facades\Fractal;

class UpdatePasswordController extends ApiController
{
    public function __invoke(UpdatePasswordRequest $request, UpdatePasswordAction $action): array|null
    {
        $user = $action->run($request);

        return Fractal::create($user, UserTransformer::class)->toArray();
    }
}
