<?php

namespace App\Containers\SocialAuth\UI\API\Controllers;

use App\Containers\SocialAuth\Actions\SocialLoginAction;
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
        $user = $this->call(SocialLoginAction::class, [$request, $provider]);

        return $this->transform($user, UserTransformer::class);
    }

}
