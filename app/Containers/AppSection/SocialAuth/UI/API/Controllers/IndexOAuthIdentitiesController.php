<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\IndexOAuthIdentitiesAction;
use App\Containers\AppSection\SocialAuth\SocialAuth;

final class IndexOAuthIdentitiesController extends ApiController
{
    public function __invoke(IndexOAuthIdentitiesAction $action): array
    {
        $result = $action->run(request()->user()->id);

        return $this->transform($result, SocialAuth::oAuthIdentityModel());
    }
}
