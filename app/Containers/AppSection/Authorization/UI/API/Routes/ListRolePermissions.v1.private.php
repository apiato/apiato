<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            ListRolePermissions
 *
 * @api                {GET} /v1/roles/:id/permissions List Role Permissions
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id id of role
 *
 * @apiUse             PermissionSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\ListRolePermissionsController;
use Illuminate\Support\Facades\Route;

Route::get('roles/{id}/permissions', ListRolePermissionsController::class)
    ->middleware(['auth:api']);
