<?php

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\CreateAdminAction;
use App\Containers\User\Actions\CreateUserAction;
use App\Containers\User\Actions\DeleteUserAction;
use App\Containers\User\Actions\GetUserAction;
use App\Containers\User\Actions\ListAndSearchUsersAction;
use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\GetUserRequest;
use App\Containers\User\UI\API\Requests\ListAllUsersRequest;
use App\Containers\User\UI\API\Requests\RefreshUserRequest;
use App\Containers\User\UI\API\Requests\RegisterUserRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\User\UI\API\Requests\DeleteUserRequest $request
     * @param \App\Containers\User\Actions\DeleteUserAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function deleteUser(DeleteUserRequest $request, DeleteUserAction $action)
    {
        $user = $action->run($request->id);

        // TODO: need update
        return $this->response->accepted(null, [
            'message' => 'User (' . $user->getHashedKey() . ') Deleted Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\ListAllUsersRequest $request
     * @param \App\Containers\User\Actions\ListAndSearchUsersAction    $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllUsers(ListAllUsersRequest $request, ListAndSearchUsersAction $action)
    {
        $users = $action->run();

        return $this->respond($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\ListAllUsersRequest $request
     * @param \App\Containers\User\Actions\ListAndSearchUsersAction    $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllClients(ListAllUsersRequest $request, ListAndSearchUsersAction $action)
    {
        $users = $action->run(); // TODO: anyone who is not an admin is a client.

        return $this->respond($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\ListAllUsersRequest $request
     * @param \App\Containers\User\Actions\ListAndSearchUsersAction    $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllAdmins(ListAllUsersRequest $request, ListAndSearchUsersAction $action)
    {
        $users = $action->run(['admin']);

        return $this->respond($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\RefreshUserRequest $request
     * @param \App\Containers\User\Actions\GetUserAction              $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function refreshUser(RefreshUserRequest $request, GetUserAction $action)
    {
        $user = $action->run($request->id, $request->header('Authorization'));

        return $this->respond($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetUserRequest $request
     * @param \App\Containers\User\Actions\GetUserAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function getUser(GetUserRequest $request, GetUserAction $action)
    {
        $user = $action->run($request->id);

        return $this->respond($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\RegisterUserRequest $request
     * @param \App\Containers\User\Actions\CreateUserAction            $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function registerUser(RegisterUserRequest $request, CreateUserAction $action)
    {
        $user = $action->run(
            $request['email'],
            $request['password'],
            $request['name'],
            $request['gender'],
            $request['birth']
        );

        return $this->respond($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\CreateAdminRequest $request
     * @param \App\Containers\User\Actions\CreateAdminAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function createAdmin(CreateAdminRequest $request, CreateAdminAction $action)
    {
        $admin = $action->run($request['email'], $request['password'], $request['name']);

        return $this->respond($admin, UserTransformer::class);
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
            $request['password'],
            $request['name'],
            $request['email'],
            $request['gender'],
            $request['birth']
        );

        return $this->respond($user, UserTransformer::class);
    }
}
