<?php

namespace App\Containers\Authorization\UI\API\Controllers;

use App\Containers\Authorization\Actions\AssignRoleAction;
use App\Containers\Authorization\Actions\AttachPermissionsToRoleAction;
use App\Containers\Authorization\Actions\CreatePermissionAction;
use App\Containers\Authorization\Actions\CreateRoleAction;
use App\Containers\Authorization\Actions\GetPermissionAction;
use App\Containers\Authorization\Actions\GetRoleAction;
use App\Containers\Authorization\Actions\ListAllPermissionsAction;
use App\Containers\Authorization\Actions\ListAllRolesAction;
use App\Containers\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\CreatePermissionRequest;
use App\Containers\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\Authorization\UI\API\Requests\GetPermissionRequest;
use App\Containers\Authorization\UI\API\Requests\GetRoleRequest;
use App\Containers\Authorization\UI\API\Requests\ListAllPermissionsRequest;
use App\Containers\Authorization\UI\API\Requests\ListAllRolesRequest;
use App\Containers\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\ListAllPermissionsRequest $request
     * @param \App\Containers\Authorization\Actions\ListAllPermissionsAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllPermissions(ListAllPermissionsRequest $request, ListAllPermissionsAction $action)
    {
        $permissions = $action->run();

        return $this->response->collection($permissions, new PermissionTransformer());
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\GetPermissionRequest $request
     * @param \App\Containers\Authorization\Actions\GetPermissionAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function getPermission(GetPermissionRequest $request, GetPermissionAction $action)
    {
        $permission = $action->run($request->name);

        return $this->response->item($permission, new PermissionTransformer());
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\ListAllRolesRequest $request
     * @param \App\Containers\Authorization\Actions\ListAllRolesAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllRoles(ListAllRolesRequest $request, ListAllRolesAction $action)
    {
        $roles = $action->run();

        return $this->response->collection($roles, new RoleTransformer());
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\GetRoleRequest $request
     * @param \App\Containers\Authorization\Actions\GetRoleAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function getRole(GetRoleRequest $request, GetRoleAction $action)
    {
        $role = $action->run($request->name);

        return $this->response->item($role, new RoleTransformer());
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\AssignUserToRoleRequest $request
     * @param \App\Containers\Authorization\Actions\AssignRoleAction                $action
     */
    public function assignUserToRole(AssignUserToRoleRequest $request, AssignRoleAction $action)
    {
        $user = $action->run($request->user_id, $request->roles_names);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\AttachPermissionToRoleRequest $request
     * @param \App\Containers\Authorization\Actions\AttachPermissionsToRoleAction         $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function attachPermissionToRole(
        AttachPermissionToRoleRequest $request,
        AttachPermissionsToRoleAction $action
    ) {
        $role = $action->run($request->role_name, $request->permission_name);

        return $this->response->item($role, new RoleTransformer());
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\CreateRoleRequest $request
     * @param \App\Containers\Authorization\Actions\CreateRoleAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function createRole(CreateRoleRequest $request, CreateRoleAction $action)
    {
        $role = $action->run($request->name, $request->description, $request->display_name);

        return $this->response->item($role, new RoleTransformer());
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\CreatePermissionRequest $request
     * @param \App\Containers\Authorization\Actions\CreatePermissionAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function createPermission(CreatePermissionRequest $request, CreatePermissionAction $action)
    {
        $permission = $action->run($request->name, $request->description, $request->display_name);

        return $this->response->item($permission, new PermissionTransformer());
    }


}
