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

class Controller extends ApiController
{
    public function registerUser(RegisterUserRequest $request): array
    {
        $user = Apiato::call('User@RegisterUserAction', [new DataTransporter($request)]);
        return $this->transform($user, UserTransformer::class);
    }

    public function createAdmin(CreateAdminRequest $request): array
    {
        $admin = Apiato::call('User@CreateAdminAction', [new DataTransporter($request)]);
        return $this->transform($admin, UserTransformer::class);
    }

    public function updateUser(UpdateUserRequest $request): array
    {
        $user = Apiato::call('User@UpdateUserAction', [new DataTransporter($request)]);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteUser(DeleteUserRequest $request): JsonResponse
    {
        Apiato::call('User@DeleteUserAction', [new DataTransporter($request)]);
        return $this->noContent();
    }

    public function getAllUsers(GetAllUsersRequest $request): array
    {
        $users = Apiato::call('User@GetAllUsersAction');
        return $this->transform($users, UserTransformer::class);
    }

    public function getAllClients(GetAllUsersRequest $request): array
    {
        $users = Apiato::call('User@GetAllClientsAction');

        return $this->transform($users, UserTransformer::class);
    }

    public function getAllAdmins(GetAllUsersRequest $request): array
    {
        $users = Apiato::call('User@GetAllAdminsAction');
        return $this->transform($users, UserTransformer::class);
    }

    public function findUserById(FindUserByIdRequest $request): array
    {
        $user = Apiato::call('User@FindUserByIdAction', [new DataTransporter($request)]);
        return $this->transform($user, UserTransformer::class);
    }

    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request): array
    {
        $user = Apiato::call('User@GetAuthenticatedUserAction');
        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        Apiato::call('User@ResetPasswordAction', [new DataTransporter($request)]);
        return $this->noContent(204);
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        Apiato::call('User@ForgotPasswordAction', [new DataTransporter($request)]);
        return $this->noContent(202);
    }

}
