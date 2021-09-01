<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\AssignUserToRoleAction;
use App\Containers\AppSection\Authorization\Actions\AttachPermissionsToRoleAction;
use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\Actions\DeleteRoleAction;
use App\Containers\AppSection\Authorization\Actions\DetachPermissionsFromRoleAction;
use App\Containers\AppSection\Authorization\Actions\FindPermissionAction;
use App\Containers\AppSection\Authorization\Actions\FindRoleAction;
use App\Containers\AppSection\Authorization\Actions\GetAllPermissionsAction;
use App\Containers\AppSection\Authorization\Actions\GetAllRolesAction;
use App\Containers\AppSection\Authorization\Actions\RevokeUserFromRoleAction;
use App\Containers\AppSection\Authorization\Actions\SyncPermissionsOnRoleAction;
use App\Containers\AppSection\Authorization\Actions\SyncUserRolesAction;
use App\Containers\AppSection\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\AppSection\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeUserFromRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    /**
     * @throws InvalidTransformerException
     */
    public function getAllPermissions(GetAllPermissionsRequest $request): array
    {
        $permissions = app(GetAllPermissionsAction::class)->run();
        return $this->transform($permissions, PermissionTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     * @throws PermissionNotFoundException
     */
    public function findPermission(FindPermissionRequest $request): array
    {
        $permission = app(FindPermissionAction::class)->run($request);
        return $this->transform($permission, PermissionTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     */
    public function getAllRoles(GetAllRolesRequest $request): array
    {
        $roles = app(GetAllRolesAction::class)->run();
        return $this->transform($roles, RoleTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     * @throws RoleNotFoundException
     */
    public function findRole(FindRoleRequest $request): array
    {
        $role = app(FindRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     */
    public function assignUserToRole(AssignUserToRoleRequest $request): array
    {
        $user = app(AssignUserToRoleAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @throws NotFoundException
     * @throws InvalidTransformerException
     */
    public function syncUserRoles(SyncUserRolesRequest $request): array
    {
        $user = app(SyncUserRolesAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteRole(DeleteRoleRequest $request): JsonResponse
    {
        app(DeleteRoleAction::class)->run($request);
        return $this->noContent();
    }

    /**
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function revokeRoleFromUser(RevokeUserFromRoleRequest $request): array
    {
        $user = app(RevokeUserFromRoleAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     */
    public function attachPermissionToRole(AttachPermissionToRoleRequest $request): array
    {
        $role = app(AttachPermissionsToRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     */
    public function syncPermissionOnRole(SyncPermissionsOnRoleRequest $request): array
    {
        $role = app(SyncPermissionsOnRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     */
    public function detachPermissionFromRole(DetachPermissionToRoleRequest $request): array
    {
        $role = app(DetachPermissionsFromRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     */
    public function createRole(CreateRoleRequest $request): array
    {
        $role = app(CreateRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }
}
