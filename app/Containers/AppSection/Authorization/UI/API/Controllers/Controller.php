<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
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
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function getAllPermissions(GetAllPermissionsRequest $request): array
    {
        $permissions = Apiato::call(GetAllPermissionsAction::class);
        return $this->transform($permissions, PermissionTransformer::class);
    }

    public function findPermission(FindPermissionRequest $request): array
    {
        $permission = Apiato::call(FindPermissionAction::class, [$request]);
        return $this->transform($permission, PermissionTransformer::class);
    }

    public function getAllRoles(GetAllRolesRequest $request): array
    {
        $roles = Apiato::call(GetAllRolesAction::class);
        return $this->transform($roles, RoleTransformer::class);
    }

    public function findRole(FindRoleRequest $request): array
    {
        $role = Apiato::call(FindRoleAction::class, [$request]);
        return $this->transform($role, RoleTransformer::class);
    }

    public function assignUserToRole(AssignUserToRoleRequest $request): array
    {
        $user = Apiato::call(AssignUserToRoleAction::class, [$request]);
        return $this->transform($user, UserTransformer::class);
    }

    public function syncUserRoles(SyncUserRolesRequest $request): array
    {
        $user = Apiato::call(SyncUserRolesAction::class, [$request]);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteRole(DeleteRoleRequest $request): JsonResponse
    {
        Apiato::call(DeleteRoleAction::class, [$request]);
        return $this->noContent();
    }

    public function revokeRoleFromUser(RevokeUserFromRoleRequest $request): array
    {
        $user = Apiato::call(RevokeUserFromRoleAction::class, [$request]);
        return $this->transform($user, UserTransformer::class);
    }

    public function attachPermissionToRole(AttachPermissionToRoleRequest $request): array
    {
        $role = Apiato::call(AttachPermissionsToRoleAction::class, [$request]);
        return $this->transform($role, RoleTransformer::class);
    }

    public function syncPermissionOnRole(SyncPermissionsOnRoleRequest $request): array
    {
        $role = Apiato::call(SyncPermissionsOnRoleAction::class, [$request]);
        return $this->transform($role, RoleTransformer::class);
    }

    public function detachPermissionFromRole(DetachPermissionToRoleRequest $request): array
    {
        $role = Apiato::call(DetachPermissionsFromRoleAction::class, [$request]);
        return $this->transform($role, RoleTransformer::class);
    }

    public function createRole(CreateRoleRequest $request): array
    {
        $role = Apiato::call(CreateRoleAction::class, [$request]);
        return $this->transform($role, RoleTransformer::class);
    }
}
