<?php

namespace App\Containers\User\Controllers;

use App\Containers\User\Requests\DeleteUserRequest;
use App\Containers\User\Requests\LoginRequest;
use App\Containers\User\Requests\RegisterRequest;
use App\Containers\User\Requests\UpdateUserRequest;
use App\Containers\User\Tasks\ApiLoginTask;
use App\Containers\User\Tasks\ApiLogoutTask;
use App\Containers\User\Tasks\CreateUserTask;
use App\Containers\User\Tasks\DeleteUserTask;
use App\Containers\User\Tasks\ListAllUsersTask;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Containers\User\Transformers\UserTransformer;
use App\Kernel\Controller\Abstracts\KernelApiController;
use App\Kernel\Request\Manager\HttpRequest;

/**
 * Class ApiController.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiController extends KernelApiController
{

    /**
     * @param \App\Containers\User\Requests\DeleteUserRequest $deleteUserRequest
     * @param \App\Containers\User\Tasks\DeleteUserTask       $deleteUserTask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function deleteUser(DeleteUserRequest $deleteUserRequest, DeleteUserTask $deleteUserTask)
    {
        $deleteUserTask->run($deleteUserRequest->id);

        return $this->response->accepted(null, [
            'message' => 'User (' . $deleteUserRequest->id . ') Deleted Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\User\Tasks\ListAllUsersTask $listAllUsersTask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllUsers(ListAllUsersTask $listAllUsersTask)
    {
        $users = $listAllUsersTask->run();

        return $this->response->paginator($users, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\Requests\LoginRequest    $loginRequest
     * @param \App\Containers\User\Tasks\ApiLoginTask $loginTask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function loginUser(LoginRequest $loginRequest, ApiLoginTask $loginTask)
    {
        $user = $loginTask->run($loginRequest['email'], $loginRequest['password']);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Kernel\Request\Manager\HttpRequest        $request
     * @param \App\Containers\User\Tasks\ApiLogoutTask $logoutTask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function logoutUser(HttpRequest $request, ApiLogoutTask $logoutTask)
    {
        $logoutTask->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\User\Requests\RegisterRequest   $registerRequest
     * @param \App\Containers\User\Tasks\CreateUserTask $createUserTask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function registerUser(RegisterRequest $registerRequest, CreateUserTask $createUserTask)
    {

        // create and login (true parameter) the new user
        $user = $createUserTask->run(
            $registerRequest['email'],
            $registerRequest['password'],
            $registerRequest['name'],
            true
        );

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\Requests\UpdateUserRequest $updateUserRequest
     * @param \App\Containers\User\Tasks\UpdateUserTask       $updateUserTask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function updateUser(UpdateUserRequest $updateUserRequest, UpdateUserTask $updateUserTask)
    {
        $user = $updateUserTask->run(
            $updateUserRequest->id,
            $updateUserRequest['password'],
            $updateUserRequest['name']
        );

        return $this->response->item($user, new UserTransformer());
    }
}
