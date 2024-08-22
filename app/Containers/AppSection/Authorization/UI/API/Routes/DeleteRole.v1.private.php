<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            DeleteRole
 *
 * @api                {delete} /v1/roles/:role_id Delete a role
 *
 * @apiDescription     Delete Role by id
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} role_id
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
 * {
 * "message": "Role (manager) Deleted Successfully."
 * }
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\DeleteRoleController;
use Illuminate\Support\Facades\Route;

Route::delete('roles/{role_id}', DeleteRoleController::class)
    ->middleware(['auth:api']);
