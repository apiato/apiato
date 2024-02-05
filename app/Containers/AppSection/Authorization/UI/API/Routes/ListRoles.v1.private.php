<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            ListRoles
 *
 * @api                {get} /v1/roles List All Roles
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiUse             RoleSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\ListRolesController;
use Illuminate\Support\Facades\Route;

Route::get('roles', ListRolesController::class)
    ->middleware(['auth:api']);
