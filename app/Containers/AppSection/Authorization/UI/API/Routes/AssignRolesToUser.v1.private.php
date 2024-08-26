<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            AssignRolesToUser
 *
 * @api                {patch} /v1/users/:user_id/roles Assign roles to user
 *
 * @apiDescription     Assign new roles to user.
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

use App\Containers\AppSection\Authorization\UI\API\Controllers\AssignRolesToUserController;
use Illuminate\Support\Facades\Route;

Route::patch('users/{user_id}/roles', AssignRolesToUserController::class)
    ->middleware(['auth:api']);
