<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;

final class GetUserProfileController extends ApiController
{
    public function __invoke(): array
    {
        return $this->transform(Auth::user(), UserTransformer::class);
    }
}
