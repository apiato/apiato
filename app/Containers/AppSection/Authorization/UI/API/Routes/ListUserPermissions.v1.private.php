<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            ListUserPermissions
 *
 * @api                {GET} /v1/users/:id/permissions List User Permissions
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id id of user
 *
 * @apiUse             PermissionSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\ListUserPermissionsController;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}/permissions', ListUserPermissionsController::class)
    ->middleware(['auth:api']);
