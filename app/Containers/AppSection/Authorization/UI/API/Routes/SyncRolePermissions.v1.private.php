<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            SyncRolePermissions
 *
 * @api                {post} /v1/permissions/sync Sync Permissions on Role
 *
 * @apiDescription     You can use this endpoint instead of `permissions/attach` & `permissions/detach`.
 *                     The sync endpoint will override all existing role permissions with the new
 *                     one sent to this endpoint.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody           {String} role_id Role ID
 * @apiBody           {Array} permission_ids Permission ID or Array of Permissions ID's
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\SyncRolePermissionsController;
use Illuminate\Support\Facades\Route;

Route::post('permissions/sync', SyncRolePermissionsController::class)
    ->middleware(['auth:api']);
