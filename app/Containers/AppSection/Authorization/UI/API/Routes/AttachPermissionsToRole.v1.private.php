<?php

/**
 * @apiGroup           RolePermission
 * @apiName            attachPermissionsToRole
 * @api                {post} /v1/permissions/attach Attach Permissions to Role
 * @apiDescription     Attach new permissions to role. This endpoint does not sync the role with the
 *                     new permissions. It simply attaches new permission to the role. So make sure
 *                     to never send an already attached permission since it will cause an error.
 *                     To sync (update) all existing permissions with the new ones use
 *                     `/permissions/sync` endpoint instead.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String} role_id Role ID
 * @apiParam           {Array} permissions_ids Permission ID or Array of Permissions ID's
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\AttachPermissionsToRoleController;
use Illuminate\Support\Facades\Route;

Route::post('permissions/attach', [AttachPermissionsToRoleController::class, 'attachPermissionsToRole'])
    ->name('api_authorization_attach_permission_to_role')
    ->middleware(['auth:api']);
