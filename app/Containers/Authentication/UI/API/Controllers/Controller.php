<?php

namespace App\Containers\Authentication\UI\API\Controllers;

use App\Containers\Authentication\Actions\ApiUserLoginAction;
use App\Containers\Authentication\Actions\ApiUserLogoutAction;
use App\Containers\Authentication\UI\API\Requests\UserLoginRequest;
use App\Containers\Authentication\UI\API\Requests\UserLogoutRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Authentication\UI\API\Requests\UserLoginRequest $request
     * @param \App\Containers\Authentication\Actions\ApiUserLoginAction       $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function userLogin(UserLoginRequest $request, ApiUserLoginAction $action)
    {
        $user = $action->run($request['email'], $request['password']);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\Authentication\UI\API\Requests\UserLogoutRequest $request
     * @param \App\Containers\Authentication\Actions\ApiUserLogoutAction       $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function userLogout(UserLogoutRequest $request, ApiUserLogoutAction $action)
    {
        $action->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }

}
