<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\SocialLoginAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;

class Controller extends ApiController
{
    public function authenticateAll(ApiAuthenticateRequest $request): array
    {
        $data = app(SocialLoginAction::class)->run($request);

        return $this->transform($data['user'], config('vendor-socialAuth.user.transformer'), [], [
            'token_type' => 'personal',
            'access_token' => $data['token']->accessToken,
        ]);
    }
}
