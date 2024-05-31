<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            SyncRolePermissions
 *
 * @api                {put} /v1/roles/:role_id/permissions Sync role permissions
 *
 * @apiDescription     Sync role permissions
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} role_id
 *
 * @apiBody            {Array} permission_ids Array of permission id's
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\SyncRolePermissionsController;
use Illuminate\Support\Facades\Route;

Route::put('roles/{role_id}/permissions', SyncRolePermissionsController::class)
    ->middleware(['auth:api']);
