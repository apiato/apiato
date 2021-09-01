<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\Actions\ForgotPasswordAction;
use App\Containers\AppSection\User\Actions\GetAllAdminsAction;
use App\Containers\AppSection\User\Actions\GetAllClientsAction;
use App\Containers\AppSection\User\Actions\GetAllUsersAction;
use App\Containers\AppSection\User\Actions\GetAuthenticatedUserAction;
use App\Containers\AppSection\User\Actions\RegisterUserAction;
use App\Containers\AppSection\User\Actions\ResetPasswordAction;
use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\AppSection\User\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\AppSection\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\AppSection\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\ResetPasswordRequest;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserPrivateProfileTransformer;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     */
    public function registerUser(RegisterUserRequest $request): array
    {
        $user = app(RegisterUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     */
    public function createAdmin(CreateAdminRequest $request): array
    {
        $admin = app(CreateAdminAction::class)->run($request);
        return $this->transform($admin, UserTransformer::class);
    }

    /**
     * @throws InternalErrorException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     * @throws InvalidTransformerException
     */
    public function updateUser(UpdateUserRequest $request): array
    {
        $user = app(UpdateUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteUser(DeleteUserRequest $request): JsonResponse
    {
        app(DeleteUserAction::class)->run($request);
        return $this->noContent();
    }

    /**
     * @throws InvalidTransformerException
     */
    public function getAllUsers(GetAllUsersRequest $request): array
    {
        $users = app(GetAllUsersAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     */
    public function getAllClients(GetAllUsersRequest $request): array
    {
        $users = app(GetAllClientsAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     */
    public function getAllAdmins(GetAllUsersRequest $request): array
    {
        $users = app(GetAllAdminsAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findUserById(FindUserByIdRequest $request): array
    {
        $user = app(FindUserByIdAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request): array
    {
        $user = app(GetAuthenticatedUserAction::class)->run();
        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

    /**
     * @throws InternalErrorException
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        app(ResetPasswordAction::class)->run($request);
        return $this->noContent();
    }

    /**
     * @throws NotFoundException
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        app(ForgotPasswordAction::class)->run($request);
        return $this->noContent(202);
    }
}
