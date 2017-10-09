<?php

namespace App\Containers\Authorization\UI\API\Controllers;

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
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\GetAllPermissionsRequest $request
     *
     * @return  mixed
     */
    public function getAllPermissions(GetAllPermissionsRequest $request)
    {
        $permissions = Apiato::call('Authorization@GetAllPermissionsAction');

        return $this->transform($permissions, PermissionTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\FindPermissionRequest $request
     *
     * @return  mixed
     */
    public function findPermission(FindPermissionRequest $request)
    {
        $permission = Apiato::call('Authorization@FindPermissionAction', [$request]);

        return $this->transform($permission, PermissionTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\GetAllRolesRequest $request
     *
     * @return  mixed
     */
    public function getAllRoles(GetAllRolesRequest $request)
    {
        $roles = Apiato::call('Authorization@GetAllRolesAction');

        return $this->transform($roles, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\FindRoleRequest $request
     *
     * @return  mixed
     */
    public function findRole(FindRoleRequest $request)
    {
        $role = Apiato::call('Authorization@FindRoleAction', [$request]);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\AssignUserToRoleRequest $request
     *
     * @return  mixed
     */
    public function assignUserToRole(AssignUserToRoleRequest $request)
    {
        $user = Apiato::call('Authorization@AssignUserToRoleAction', [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\SyncUserRolesRequest $request
     *
     * @return  mixed
     */
    public function syncUserRoles(SyncUserRolesRequest $request)
    {
        $user = Apiato::call('Authorization@SyncUserRolesAction', [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\DeleteRoleRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleteRole(DeleteRoleRequest $request)
    {
        $role = Apiato::call('Authorization@DeleteRoleAction', [$request]);

        return $this->accepted([
            'message' => 'Role (' . $role->getHashedKey() . ') Deleted Successfully.'
        ]);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\RevokeUserFromRoleRequest $request
     *
     * @return  mixed
     */
    public function revokeRoleFromUser(RevokeUserFromRoleRequest $request)
    {
        $user = Apiato::call('Authorization@RevokeUserFromRoleAction', [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\AttachPermissionToRoleRequest $request
     *
     * @return  mixed
     */
    public function attachPermissionToRole(AttachPermissionToRoleRequest $request)
    {
        $role = Apiato::call('Authorization@AttachPermissionsToRoleAction', [$request]);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest $request
     *
     * @return  mixed
     */
    public function syncPermissionOnRole(SyncPermissionsOnRoleRequest $request)
    {
        $role = Apiato::call('Authorization@SyncPermissionsOnRoleAction', [$request]);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\DetachPermissionToRoleRequest $request
     *
     * @return  mixed
     */
    public function detachPermissionFromRole(DetachPermissionToRoleRequest $request)
    {
        $role = Apiato::call('Authorization@DetachPermissionsFromRoleAction', [$request]);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\CreateRoleRequest $request
     *
     * @return  mixed
     */
    public function createRole(CreateRoleRequest $request)
    {
        $role = Apiato::call('Authorization@CreateRoleAction', [$request]);

        return $this->transform($role, RoleTransformer::class);
    }

}
