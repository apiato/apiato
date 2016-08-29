<?php

namespace App\Containers\SocialAuthentication\UI\API\Controllers;

use App\Containers\SocialAuthentication\Actions\SocialLoginAction;
use App\Containers\SocialAuthentication\SocialProvider;
use App\Containers\SocialAuthentication\UI\API\Requests\AuthenticateOneRequest;
use App\Containers\SocialAuthentication\UI\API\Requests\AuthenticateTwoRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Port\Controller\Abstracts\PortApiController;
use Dingo\Api\Http\Request;

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
    public function authenticateTwitter(AuthenticateOneRequest $request, SocialLoginAction $action)
    {
        $user = $action->run(SocialProvider::TWITTER);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\SocialAuthentication\UI\API\Requests\AuthenticateTwoRequest $request
     * @param \App\Containers\SocialAuthentication\Actions\SocialLoginAction              $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function authenticateFacebook(AuthenticateTwoRequest $request, SocialLoginAction $action)
    {
        $user = $action->run(SocialProvider::FACEBOOK);

        return $this->response->item($user, new UserTransformer());
    }


    /**
     * @param \App\Containers\SocialAuthentication\UI\API\Requests\AuthenticateTwoRequest $request
     * @param \App\Containers\SocialAuthentication\Actions\SocialLoginAction              $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function authenticateGoogle(AuthenticateTwoRequest $request, SocialLoginAction $action)
    {
        $user = $action->run(SocialProvider::GOOGLE);

        return $this->response->item($user, new UserTransformer());
    }


}
