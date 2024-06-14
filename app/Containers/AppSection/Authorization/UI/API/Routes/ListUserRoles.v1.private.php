<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            ListUserRoles
 *
 * @api                {GET} /v1/users/:user_id/roles List user roles
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
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\ListUserRolesController;
use Illuminate\Support\Facades\Route;

Route::get('users/{user_id}/roles', ListUserRolesController::class)
    ->middleware(['auth:api']);
