<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            SyncUserRoles
 *
 * @api                {put} /v1/users/:user_id/roles Sync user roles
 *
 * @apiDescription     Sync user roles
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

use App\Containers\AppSection\Authorization\UI\API\Controllers\SyncUserRolesController;
use Illuminate\Support\Facades\Route;

Route::put('users/{user_id}/roles', SyncUserRolesController::class)
    ->middleware(['auth:api']);
