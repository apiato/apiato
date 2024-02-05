<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            AssignRolesToUser
 *
 * @api                {post} /v1/roles/assign Assign User to Roles
 *
 * @apiDescription     Assign new roles to user. This endpoint does not sync the user with the
 *                     new roles. It simply assigns new role to the user. So make sure
 *                     to never send an already assigned role since it will cause an error.
 *                     To sync (update) all existing roles with the new ones use
 *                     `/roles/sync` endpoint instead.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-admins-access', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody           {Number} user_id User ID
 * @apiBody           {Array} role_ids Role ID or Array of Roles ID's
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\AssignRolesToUserController;
use Illuminate\Support\Facades\Route;

Route::post('roles/assign', AssignRolesToUserController::class)
    ->middleware(['auth:api']);
