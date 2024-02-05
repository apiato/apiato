<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            DeleteRole
 *
 * @api                {delete} /v1/roles/:id Delete a Role
 *
 * @apiDescription     Delete Role by ID
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id role id
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
 * {
 * "message": "Role (manager) Deleted Successfully."
 * }
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\DeleteRoleController;
use Illuminate\Support\Facades\Route;

Route::delete('roles/{id}', DeleteRoleController::class)
    ->middleware(['auth:api']);
