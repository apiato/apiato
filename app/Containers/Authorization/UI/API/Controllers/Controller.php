<?php

namespace App\Containers\Authorization\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Containers\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Containers\Authorization\UI\API\Requests\FindRoleRequest;
use App\Containers\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Containers\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Containers\Authorization\UI\API\Requests\RevokeUserFromRoleRequest;
use App\Containers\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Containers\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function getAllPermissions(GetAllPermissionsRequest $request): array
    {
        $permissions = Apiato::call('Authorization@GetAllPermissionsAction');
        return $this->transform($permissions, PermissionTransformer::class);
    }

    public function findPermission(FindPermissionRequest $request): array
    {
        $permission = Apiato::call('Authorization@FindPermissionAction', [$request]);
        return $this->transform($permission, PermissionTransformer::class);
    }

    public function getAllRoles(GetAllRolesRequest $request): array
    {
        $roles = Apiato::call('Authorization@GetAllRolesAction');
        return $this->transform($roles, RoleTransformer::class);
    }

    public function findRole(FindRoleRequest $request): array
    {
        $role = Apiato::call('Authorization@FindRoleAction', [$request]);
        return $this->transform($role, RoleTransformer::class);
    }

    public function assignUserToRole(AssignUserToRoleRequest $request): array
    {
        $user = Apiato::call('Authorization@AssignUserToRoleAction', [$request]);
        return $this->transform($user, UserTransformer::class);
    }

    public function syncUserRoles(SyncUserRolesRequest $request): array
    {
        $user = Apiato::call('Authorization@SyncUserRolesAction', [$request]);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteRole(DeleteRoleRequest $request): JsonResponse
    {
        Apiato::call('Authorization@DeleteRoleAction', [$request]);
        return $this->noContent();
    }

    public function revokeRoleFromUser(RevokeUserFromRoleRequest $request): array
    {
        $user = Apiato::call('Authorization@RevokeUserFromRoleAction', [$request]);
        return $this->transform($user, UserTransformer::class);
    }

    public function attachPermissionToRole(AttachPermissionToRoleRequest $request): array
    {
        $role = Apiato::call('Authorization@AttachPermissionsToRoleAction', [$request]);
        return $this->transform($role, RoleTransformer::class);
    }

    public function syncPermissionOnRole(SyncPermissionsOnRoleRequest $request): array
    {
        $role = Apiato::call('Authorization@SyncPermissionsOnRoleAction', [$request]);
        return $this->transform($role, RoleTransformer::class);
    }

    public function detachPermissionFromRole(DetachPermissionToRoleRequest $request): array
    {
        $role = Apiato::call('Authorization@DetachPermissionsFromRoleAction', [$request]);
        return $this->transform($role, RoleTransformer::class);
    }

    public function createRole(CreateRoleRequest $request): array
    {
        $role = Apiato::call('Authorization@CreateRoleAction', [$request]);
        return $this->transform($role, RoleTransformer::class);
    }
}
