<?php

namespace App\Containers\SocialAuth\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

class Controller extends ApiController
{
    public function authenticateAll(ApiAuthenticateRequest $request, $provider): array
    {
        $dataTransporter = new DataTransporter($request);
        $dataTransporter->provider = $provider;

        $data = Apiato::call('SocialAuth@SocialLoginAction', [$dataTransporter]);

        return $this->transform($data['user'], UserTransformer::class, [], [
            'token_type' => 'personal',
            'access_token' => $data['token']->accessToken,
        ]);
    }
}
