<?php

namespace App\Containers\User\Controllers;

use App\Containers\User\Requests\DeleteUserRequest;
use App\Containers\User\Requests\LoginRequest;
use App\Containers\User\Requests\RegisterRequest;
use App\Containers\User\Requests\UpdateUserRequest;
use App\Containers\User\Actions\ApiLoginAction;
use App\Containers\User\Actions\ApiLogoutAction;
use App\Containers\User\Actions\CreateUserAction;
use App\Containers\User\Actions\DeleteUserAction;
use App\Containers\User\Actions\ListAllUsersAction;
use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\Transformers\UserTransformer;
use App\Ship\Controller\Abstracts\KernelApiController;
use App\Ship\Request\Manager\HttpRequest;

/**
 * Class ApiController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiController extends KernelApiController
{

    /**
     * @param \App\Containers\User\Requests\DeleteUserRequest $deleteUserRequest
     * @param \App\Containers\User\Actions\DeleteUserAction       $deleteUserAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function deleteUser(DeleteUserRequest $deleteUserRequest, DeleteUserAction $deleteUserAction)
    {
        $deleteUserAction->run($deleteUserRequest->id);

        return $this->response->accepted(null, [
            'message' => 'User (' . $deleteUserRequest->id . ') Deleted Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\User\Actions\ListAllUsersAction $listAllUsersAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllUsers(ListAllUsersAction $listAllUsersAction)
    {
        $users = $listAllUsersAction->run();

        return $this->response->paginator($users, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\Requests\LoginRequest    $loginRequest
     * @param \App\Containers\User\Actions\ApiLoginAction $loginAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function loginUser(LoginRequest $loginRequest, ApiLoginAction $loginAction)
    {
        $user = $loginAction->run($loginRequest['email'], $loginRequest['password']);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Ship\Request\Manager\HttpRequest        $request
     * @param \App\Containers\User\Actions\ApiLogoutAction $logoutAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function logoutUser(HttpRequest $request, ApiLogoutAction $logoutAction)
    {
        $logoutAction->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\User\Requests\RegisterRequest   $registerRequest
     * @param \App\Containers\User\Actions\CreateUserAction $createUserAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function registerUser(RegisterRequest $registerRequest, CreateUserAction $createUserAction)
    {

        // create and login (true parameter) the new user
        $user = $createUserAction->run(
            $registerRequest['email'],
            $registerRequest['password'],
            $registerRequest['name'],
            true
        );

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\Requests\UpdateUserRequest $updateUserRequest
     * @param \App\Containers\User\Actions\UpdateUserAction       $updateUserAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function updateUser(UpdateUserRequest $updateUserRequest, UpdateUserAction $updateUserAction)
    {
        $user = $updateUserAction->run(
            $updateUserRequest->id,
            $updateUserRequest['password'],
            $updateUserRequest['name']
        );

        return $this->response->item($user, new UserTransformer());
    }
}
