<?php

/**
 * @apiGroup           RolePermission
 * @apiName            assignRolesToUser
 * @api                {post} /v1/roles/assign Assign User to Roles
 * @apiDescription     Assign new roles to user. This endpoint does not sync the user with the
 *                     new roles. It simply assigns new role to the user. So make sure
 *                     to never send an already assigned role since it will cause an error.
 *                     To sync (update) all existing roles with the new ones use
 *                     `/roles/sync` endpoint instead.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {Number} user_id User ID
 * @apiParam           {Array} roles_ids Role ID or Array of Roles ID's
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\AssignRolesToUserController;
use Illuminate\Support\Facades\Route;

Route::post('roles/assign', [AssignRolesToUserController::class, 'assignRolesToUser'])
    ->name('api_authorization_assign_role_to_user')
    ->middleware(['auth:api']);
