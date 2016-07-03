<?php

namespace App\Containers\User\Controllers;

use App\Containers\User\Requests\DeleteUserRequest;
use App\Containers\User\Requests\LoginRequest;
use App\Containers\User\Requests\RegisterRequest;
use App\Containers\User\Requests\UpdateUserRequest;
use App\Containers\User\Subtasks\ApiLoginSubtask;
use App\Containers\User\Subtasks\ApiLogoutSubtask;
use App\Containers\User\Subtasks\CreateUserSubtask;
use App\Containers\User\Subtasks\DeleteUserSubtask;
use App\Containers\User\Subtasks\ListAllUsersSubtask;
use App\Containers\User\Subtasks\UpdateUserSubtask;
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
     * @param \App\Containers\User\Subtasks\DeleteUserSubtask $deleteUserSubtask
     * @param                                                 $userId
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function deleteUser(DeleteUserRequest $deleteUserRequest, DeleteUserSubtask $deleteUserSubtask, $userId)
    {
        $deleteUserSubtask->run($userId);

        return $this->response->accepted(null, [
            'message' => 'User (' . $userId . ') Deleted Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\User\Subtasks\ListAllUsersSubtask $listAllUsersSubtask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllUsers(ListAllUsersSubtask $listAllUsersSubtask)
    {
        $users = $listAllUsersSubtask->run();

        return $this->response->paginator($users, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\Requests\LoginRequest    $loginRequest
     * @param \App\Containers\User\Subtasks\ApiLoginSubtask $loginSubtask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function loginUser(LoginRequest $loginRequest, ApiLoginSubtask $loginSubtask)
    {
        $user = $loginSubtask->run($loginRequest['email'], $loginRequest['password']);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Kernel\Request\Manager\HttpRequest        $request
     * @param \App\Containers\User\Subtasks\ApiLogoutSubtask $logoutSubtask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function logoutUser(HttpRequest $request, ApiLogoutSubtask $logoutSubtask)
    {
        $logoutSubtask->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\User\Requests\RegisterRequest   $registerRequest
     * @param \App\Containers\User\Subtasks\CreateUserSubtask $createUserSubtask
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function registerUser(RegisterRequest $registerRequest, CreateUserSubtask $createUserSubtask)
    {

        // create and login (true parameter) the new user
        $user = $createUserSubtask->run(
            $registerRequest['email'],
            $registerRequest['password'],
            $registerRequest['name'],
            true
        );

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\Requests\UpdateUserRequest $updateUserRequest
     * @param \App\Containers\User\Subtasks\UpdateUserSubtask $updateUserSubtask
     * @param                                                 $userId
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function updateUser(UpdateUserRequest $updateUserRequest, UpdateUserSubtask $updateUserSubtask, $userId)
    {
        $user = $updateUserSubtask->run(
            $userId,
            $updateUserRequest['password'],
            $updateUserRequest['name']
        );

        return $this->response->item($user, new UserTransformer());
    }
}
