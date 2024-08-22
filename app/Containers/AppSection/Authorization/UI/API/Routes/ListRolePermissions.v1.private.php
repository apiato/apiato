<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            ListRolePermissions
 *
 * @api                {GET} /v1/roles/:role_id/permissions List role permissions
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} role_id
 *
 * @apiUse             PermissionSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\ListRolePermissionsController;
use Illuminate\Support\Facades\Route;

Route::get('roles/{role_id}/permissions', ListRolePermissionsController::class)
    ->middleware(['auth:api']);
