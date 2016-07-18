<?php

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\ApiLoginAction;
use App\Containers\User\Actions\ApiLogoutAction;
use App\Containers\User\Actions\CreateUserAction;
use App\Containers\User\Actions\DeleteUserAction;
use App\Containers\User\Actions\ListAllUsersAction;
use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\LoginRequest;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Port\Controller\Abstracts\PortApiController;
use App\Port\Request\Manager\HttpRequest;

/**
 * Class ApiController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiController extends PortApiController
{

    /**
     * @param \App\Containers\User\UI\API\Requests\DeleteUserRequest $request
     * @param \App\Containers\User\Actions\DeleteUserAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function deleteUser(DeleteUserRequest $request, DeleteUserAction $action)
    {
        $action->run($request->id);

        return $this->response->accepted(null, [
            'message' => 'User (' . $request->id . ') Deleted Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\User\Actions\ListAllUsersAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllUsers(ListAllUsersAction $action)
    {
        $users = $action->run();

        return $this->response->paginator($users, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\LoginRequest $request
     * @param \App\Containers\User\Actions\ApiLoginAction       $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function loginUser(LoginRequest $request, ApiLoginAction $action)
    {
        $user = $action->run($request['email'], $request['password']);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Port\Request\Manager\HttpRequest        $request
     * @param \App\Containers\User\Actions\ApiLogoutAction $action
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

    /**
     * @param \App\Containers\User\UI\API\Requests\RegisterRequest $request
     * @param \App\Containers\User\Actions\CreateUserAction        $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function registerUser(RegisterRequest $request, CreateUserAction $action)
    {
        // create and login (true parameter) the new user
        $user = $action->run(
            $request['email'],
            $request['password'],
            $request['name'],
            true
        );

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\UpdateUserRequest $request
     * @param \App\Containers\User\Actions\UpdateUserAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function updateUser(UpdateUserRequest $request, UpdateUserAction $action)
    {
        $user = $action->run(
            $request->id,
            $request['password'],
            $request['name']
        );

        return $this->response->item($user, new UserTransformer());
    }
}
