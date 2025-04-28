<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\UpdatePasswordAction;
use App\Containers\AppSection\User\UI\API\Requests\UpdatePasswordRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class UpdatePasswordController extends ApiController
{
    public function __invoke(UpdatePasswordRequest $request, UpdatePasswordAction $action): array
    {
        $request->mapInput([
            'new_password' => 'password',
        ]);
        $user = $action->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
