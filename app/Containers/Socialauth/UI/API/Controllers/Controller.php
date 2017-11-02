<?php

namespace App\Containers\SocialAuth\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\SocialAuth\UI\API\Requests\ApiAuthenticateRequest $request
     * @param                                                                   $provider
     *
     * @return  mixed
     */
    public function authenticateAll(ApiAuthenticateRequest $request, $provider)
    {
        $data = Apiato::call('Socialauth@SocialLoginAction', [$request, $provider]);

        return $this->transform($data['user'], UserTransformer::class, [], [
            'token_type'   => 'personal',
            'access_token' => $data['token']->accessToken,
        ]);
    }

}
