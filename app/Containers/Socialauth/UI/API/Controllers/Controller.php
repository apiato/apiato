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
     * @param \App\Containers\SocialAuth\Actions\SocialLoginAction              $action
     * @param                                                                   $provider
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function authenticateAll(ApiAuthenticateRequest $request, SocialLoginAction $action, $provider)
    {
        $user = $action->run($provider, $request->all());

        return $this->respond($user, UserTransformer::class);
    }

}
