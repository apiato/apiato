<?php

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\GetMyProfileRequest;
use App\Containers\User\UI\API\Requests\GetUserByIdRequest;
use App\Containers\User\UI\API\Requests\ListAllUsersRequest;
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
     * @param \App\Containers\User\UI\API\Requests\RegisterUserRequest $request
     *
     * @return  mixed
     */
    public function registerUser(RegisterUserRequest $request)
    {
        $user = $this->call('User@RegisterUserAction', [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\CreateAdminRequest $request
     *
     * @return  mixed
     */
    public function createAdmin(CreateAdminRequest $request)
    {
        $admin = $this->call('User@CreateAdminAction', [$request]);

        return $this->transform($admin, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\UpdateUserRequest $request
     *
     * @return  mixed
     */
    public function updateUser(UpdateUserRequest $request)
    {
        $user = $this->call('User@UpdateUserAction', [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\DeleteUserRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleteUser(DeleteUserRequest $request)
    {
        $user = $this->call('User@DeleteUserAction', [$request]);

        return $this->deleted($user);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\ListAllUsersRequest $request
     *
     * @return  mixed
     */
    public function listAllUsers(ListAllUsersRequest $request)
    {
        $users = $this->call('User@ListAndSearchUsersAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\ListAllUsersRequest $request
     *
     * @return  mixed
     */
    public function listAllClients(ListAllUsersRequest $request)
    {
        $users = $this->call('User@ListClientsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\ListAllUsersRequest $request
     *
     * @return  mixed
     */
    public function listAllAdmins(ListAllUsersRequest $request)
    {
        $users = $this->call('User@ListAdminsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetUserByIdRequest $request
     *
     * @return  mixed
     */
    public function getUser(GetUserByIdRequest $request)
    {
        $user = $this->call('User@GetUserAction', [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param GetMyProfileRequest $request
     *
     * @return mixed
     */
    public function getUserProfile(GetMyProfileRequest $request)
    {
        $user = $this->call('User@GetMyProfileAction', [$request]);

        return $this->transform($user, UserTransformer::class, ['roles']);
    }

}
