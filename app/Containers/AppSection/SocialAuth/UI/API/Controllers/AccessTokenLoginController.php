<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\SocialLoginAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\AccessTokenLoginRequest;
use Laravel\Socialite\SocialiteManager;

final class AccessTokenLoginController extends ApiController
{
    public function __invoke(AccessTokenLoginRequest $request)
    {
        dd(request());
    }
}
