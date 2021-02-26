<?php

namespace App\Containers\User\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\User\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\User\UI\API\Requests\RegisterUserRequest;
use App\Containers\User\UI\API\Requests\ResetPasswordRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\User\UI\API\Transformers\UserPrivateProfileTransformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Http\JsonResponse;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param RegisterUserRequest $request
     *
     * @return  mixed
     */
    public function registerUser(RegisterUserRequest $request)
    {
        $user = Apiato::call('User@RegisterUserAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param CreateAdminRequest $request
     *
     * @return  mixed
     */
    public function createAdmin(CreateAdminRequest $request)
    {
        $admin = Apiato::call('User@CreateAdminAction', [new DataTransporter($request)]);

        return $this->transform($admin, UserTransformer::class);
    }

    /**
     * @param UpdateUserRequest $request
     *
     * @return  mixed
     */
    public function updateUser(UpdateUserRequest $request)
    {
        $user = Apiato::call('User@UpdateUserAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param DeleteUserRequest $request
     *
     * @return  JsonResponse
     */
    public function deleteUser(DeleteUserRequest $request)
    {
        Apiato::call('User@DeleteUserAction', [new DataTransporter($request)]);

        return $this->noContent();
    }

    /**
     * @param GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllUsers(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllUsersAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllClients(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllClientsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllAdmins(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllAdminsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param FindUserByIdRequest $request
     *
     * @return  mixed
     */
    public function findUserById(FindUserByIdRequest $request)
    {
        $user = Apiato::call('User@FindUserByIdAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param GetAuthenticatedUserRequest $request
     *
     * @return mixed
     */
    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request)
    {
        $user = Apiato::call('User@GetAuthenticatedUserAction');

        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

    /**
     * @param ResetPasswordRequest $request
     *
     * @return  JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        Apiato::call('User@ResetPasswordAction', [new DataTransporter($request)]);

        return $this->noContent(204);
    }

    /**
     * @param ForgotPasswordRequest $request
     *
     * @return  JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        Apiato::call('User@ForgotPasswordAction', [new DataTransporter($request)]);

        return $this->noContent(202);
    }

}
