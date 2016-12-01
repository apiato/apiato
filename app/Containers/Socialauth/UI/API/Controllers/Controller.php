<?php

namespace App\Containers\SocialAuth\UI\API\Controllers;

use App\Containers\SocialAuth\Actions\SocialLoginAction;
use App\Containers\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
use App\Containers\SocialAuth\UI\API\Requests\AuthenticateCallbackRequest;
use App\Containers\SocialAuth\UI\API\Requests\AuthenticateOneRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\SocialAuth\UI\API\Requests\ApiAuthenticateRequest $request
     * @param \App\Containers\SocialAuth\Actions\SocialLoginAction              $action
     * @param                                                                             $provider
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function authenticateAll(ApiAuthenticateRequest $request, SocialLoginAction $action, $provider)
    {
        $user = $action->run($provider, $request->header('visitor-id'), $request->all());

        return $this->response->item($user, new UserTransformer());
    }

}
