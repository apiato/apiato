<?php

/**
 * @apiGroup           RolePermission
 * @apiName            RevokeRolesFromUser
 * @api                {post} /v1/roles/revoke Revoke/Remove Roles from User
 * @apiDescription     Revoke existing roles from user. This endpoint does not sync the user
 *                     It just revokes the passed role from the user. So make sure
 *                     to never send a non-assigned role since it will cause an error.
 *                     To sync (update) all existing roles with the new ones use
 *                     `/roles/sync` endpoint instead.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-admins-access', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody           {Number} user_id user ID
 * @apiBody           {Array} roles_ids Role ID or Array of Role ID's
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\RevokeRolesFromUserController;
use Illuminate\Support\Facades\Route;

Route::post('roles/revoke', [RevokeRolesFromUserController::class, 'revokeRolesFromUser'])
    ->middleware(['auth:api']);
