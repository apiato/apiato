<?php

namespace App\Containers\Authentication\UI\API\Controllers;

use App\Containers\Authentication\Actions\ApiLoginAction;
use App\Containers\Authentication\Actions\ApiLogoutAction;
use App\Containers\Authentication\UI\API\Requests\LoginRequest;
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
     * @param \App\Containers\Authentication\Actions\ApiLoginAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function loginUser(LoginRequest $request, ApiLoginAction $action)
    {
        $user = $action->run($request['email'], $request['password']);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Port\Request\Manager\HttpRequest                  $request
     * @param \App\Containers\Authentication\Actions\ApiLogoutAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function logoutUser(HttpRequest $request, ApiLogoutAction $action)
    {
        $action->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }

}
