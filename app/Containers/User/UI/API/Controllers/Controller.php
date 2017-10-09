<?php

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\CreateAdminAction;
use App\Containers\User\Actions\DeleteUserAction;
use App\Containers\User\Actions\FindMyProfileAction;
use App\Containers\User\Actions\FindUserAction;
use App\Containers\User\Actions\GetAllAdminsAction;
use App\Containers\User\Actions\GetAllAndSearchUsersAction;
use App\Containers\User\Actions\GetAllClientsAction;
use App\Containers\User\Actions\RegisterUserAction;
use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\FindMyProfileRequest;
use App\Containers\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\User\UI\API\Requests\GetAllUsersRequest;
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
        $user = $this->call(RegisterUserAction::class, [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\CreateAdminRequest $request
     *
     * @return  mixed
     */
    public function createAdmin(CreateAdminRequest $request)
    {
        $admin = $this->call(CreateAdminAction::class, [$request]);

        return $this->transform($admin, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\UpdateUserRequest $request
     *
     * @return  mixed
     */
    public function updateUser(UpdateUserRequest $request)
    {
        $user = $this->call(UpdateUserAction::class, [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\DeleteUserRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleteUser(DeleteUserRequest $request)
    {
        $user = $this->call(DeleteUserAction::class, [$request]);

        return $this->deleted($user);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllUsers(GetAllUsersRequest $request)
    {
        $users = $this->call(GetAllAndSearchUsersAction::class);

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllClients(GetAllUsersRequest $request)
    {
        $users = $this->call(GetAllClientsAction::class);

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllAdmins(GetAllUsersRequest $request)
    {
        $users = $this->call(GetAllAdminsAction::class);

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\FindUserByIdRequest $request
     *
     * @return  mixed
     */
    public function findUser(FindUserByIdRequest $request)
    {
        $user = $this->call(FindUserAction::class, [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param FindMyProfileRequest $request
     *
     * @return mixed
     */
    public function findUserProfile(FindMyProfileRequest $request)
    {
        $user = $this->call(FindMyProfileAction::class, [$request]);

        return $this->transform($user, UserTransformer::class, ['roles']);
    }

}
