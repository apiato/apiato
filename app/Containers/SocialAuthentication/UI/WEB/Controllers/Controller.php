<?php

namespace App\Containers\SocialAuthentication\UI\WEB\Controllers;

use App\Containers\SocialAuthentication\Actions\SocialLoginAction;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Port\Controller\Abstracts\PortWebController;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends PortWebController
{

    /**
     * WEB Callback handler only, all the others are for API from Mobile.
     *
     * @param                                                                $provider
     * @param \App\Containers\SocialAuthentication\Actions\SocialLoginAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function webAuthenticateAll($provider, SocialLoginAction $action)
    {
        $user = $action->run($provider);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param $provider
     *
     * @return  mixed
     */
    public function webRedirectAll($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
}
