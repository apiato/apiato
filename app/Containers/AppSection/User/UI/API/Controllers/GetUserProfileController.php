<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\GetUserProfileAction;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetUserProfileController extends ApiController
{
    public function __invoke(GetUserProfileAction $action): array
    {
        $authenticatable = $action->run();

        return $this->transform($authenticatable, UserTransformer::class);
    }
}
