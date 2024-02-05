<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            ListUserRoles
 *
 * @api                {GET} /v1/users/:id/roles List User Roles
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id user id
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\ListUserRolesController;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}/roles', ListUserRolesController::class)
    ->middleware(['auth:api']);
