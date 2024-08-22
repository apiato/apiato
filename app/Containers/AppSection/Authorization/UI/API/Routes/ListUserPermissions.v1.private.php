<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            ListUserPermissions
 *
 * @api                {GET} /v1/users/:user_id/permissions List user permissions
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} user_id
 *
 * @apiUse             PermissionSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\ListUserPermissionsController;
use Illuminate\Support\Facades\Route;

Route::get('users/{user_id}/permissions', ListUserPermissionsController::class)
    ->middleware(['auth:api']);
