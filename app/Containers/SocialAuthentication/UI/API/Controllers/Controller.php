<?php

namespace App\Containers\SocialAuthentication\UI\API\Controllers;

use App\Containers\SocialAuthentication\Actions\SocialLoginAction;
use App\Containers\SocialAuthentication\UI\API\Requests\ApiAuthenticateRequest;
use App\Containers\SocialAuthentication\UI\API\Requests\AuthenticateCallbackRequest;
use App\Containers\SocialAuthentication\UI\API\Requests\AuthenticateOneRequest;
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
     * @param \App\Containers\SocialAuthentication\UI\API\Requests\AuthenticateOneRequest $request
     * @param \App\Containers\SocialAuthentication\Actions\SocialLoginAction              $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function apiAuthenticateAll(ApiAuthenticateRequest $request, SocialLoginAction $action, $provider)
    {
        $user = $action->run($provider, $request->header('visitor-id'), $request->all());

        return $this->response->item($user, new UserTransformer());
    }

}
