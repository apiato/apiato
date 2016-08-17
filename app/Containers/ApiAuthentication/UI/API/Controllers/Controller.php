<?php

namespace App\Containers\ApiAuthentication\UI\API\Controllers;

use App\Containers\ApiAuthentication\Actions\LoginAction;
use App\Containers\ApiAuthentication\Actions\LogoutAction;
use App\Containers\ApiAuthentication\UI\API\Requests\LoginRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Port\Controller\Abstracts\PortApiController;
use App\Port\Request\Manager\HttpRequest;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\User\UI\API\Requests\LoginRequest     $request
     * @param \App\Containers\ApiAuthentication\Actions\LoginAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function loginUser(LoginRequest $request, LoginAction $action)
    {
        $user = $action->run($request['email'], $request['password']);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Port\Request\Manager\HttpRequest                  $request
     * @param \App\Containers\ApiAuthentication\Actions\LogoutAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function logoutUser(HttpRequest $request, LogoutAction $action)
    {
        $action->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }

}
