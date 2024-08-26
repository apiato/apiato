<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            RemoveUserRoles
 *
 * @api                {delete} /v1/users/:user_id/roles Remove user roles
 *
 * @apiDescription     Remove existing roles from a user
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-admins-access', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} user_id
 *
 * @apiBody            {Array} role_ids Array of role id's
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\RemoveUserRolesController;
use Illuminate\Support\Facades\Route;

Route::delete('users/{user_id}/roles', RemoveUserRolesController::class)
    ->middleware(['auth:api']);
