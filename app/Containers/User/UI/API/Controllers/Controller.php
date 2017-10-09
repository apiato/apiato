<?php

namespace App\Containers\User\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
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
        $user = Apiato::call('User@RegisterUserAction', [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\CreateAdminRequest $request
     *
     * @return  mixed
     */
    public function createAdmin(CreateAdminRequest $request)
    {
        $admin = Apiato::call('User@CreateAdminAction', [$request]);

        return $this->transform($admin, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\UpdateUserRequest $request
     *
     * @return  mixed
     */
    public function updateUser(UpdateUserRequest $request)
    {
        $user = Apiato::call('User@UpdateUserAction', [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\DeleteUserRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleteUser(DeleteUserRequest $request)
    {
        $user = Apiato::call('User@DeleteUserAction', [$request]);

        return $this->deleted($user);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllUsers(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllAndSearchUsersAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllClients(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllClientsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllAdmins(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllAdminsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\FindUserByIdRequest $request
     *
     * @return  mixed
     */
    public function findUser(FindUserByIdRequest $request)
    {
        $user = Apiato::call('User@FindUserAction', [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param FindMyProfileRequest $request
     *
     * @return mixed
     */
    public function findUserProfile(FindMyProfileRequest $request)
    {
        $user = Apiato::call('User@FindMyProfileAction', [$request]);

        return $this->transform($user, UserTransformer::class, ['roles']);
    }

}
