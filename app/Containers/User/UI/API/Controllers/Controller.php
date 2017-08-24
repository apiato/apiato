<?php

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\CreateAdminAction;
use App\Containers\User\Actions\DeleteUserAction;
use App\Containers\User\Actions\GetMyProfileAction;
use App\Containers\User\Actions\GetUserAction;
use App\Containers\User\Actions\ListAdminsAction;
use App\Containers\User\Actions\ListAndSearchUsersAction;
use App\Containers\User\Actions\ListClientsAction;
use App\Containers\User\Actions\RegisterUserAction;
use App\Containers\User\Actions\UpdateUserAction;
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
     * @param \App\Containers\User\UI\API\Requests\ListAllUsersRequest $request
     *
     * @return  mixed
     */
    public function listAllUsers(ListAllUsersRequest $request)
    {
        $users = $this->call(ListAndSearchUsersAction::class);

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\ListAllUsersRequest $request
     *
     * @return  mixed
     */
    public function listAllClients(ListAllUsersRequest $request)
    {
        $users = $this->call(ListClientsAction::class);

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\ListAllUsersRequest $request
     *
     * @return  mixed
     */
    public function listAllAdmins(ListAllUsersRequest $request)
    {
        $users = $this->call(ListAdminsAction::class);

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetUserByIdRequest $request
     *
     * @return  mixed
     */
    public function getUser(GetUserByIdRequest $request)
    {
        $user = $this->call(GetUserAction::class, [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param GetMyProfileRequest $request
     *
     * @return mixed
     */
    public function getUserProfile(GetMyProfileRequest $request)
    {
        $user = $this->call(GetMyProfileAction::class, [$request]);

        return $this->transform($user, UserTransformer::class, ['roles']);
    }

}
