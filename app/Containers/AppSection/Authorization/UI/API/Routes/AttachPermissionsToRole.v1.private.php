<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            AttachPermissionsToRole
 *
 * @api                {post} /v1/permissions/attach Attach Permissions to Role
 *
 * @apiDescription     Attach new permissions to role. This endpoint does not sync the role with the
 *                     new permissions. It simply attaches new permission to the role. So make sure
 *                     to never send an already attached permission since it will cause an error.
 *                     To sync (update) all existing permissions with the new ones use
 *                     `/permissions/sync` endpoint instead.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody           {String} role_id Role ID
 * @apiBody           {Array} permissions_ids Array of Permissions ID's
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\AttachPermissionsToRoleController;
use Illuminate\Support\Facades\Route;

Route::post('permissions/attach', AttachPermissionsToRoleController::class)
    ->middleware(['auth:api']);
