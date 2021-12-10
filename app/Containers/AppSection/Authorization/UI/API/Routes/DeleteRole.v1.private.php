<?php

/**
 * @apiGroup           RolePermission
 * @apiName            DeleteRole
 * @api                {delete} /v1/roles/:id Delete a Role
 * @apiDescription     Delete Role by ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Role
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
 * {
 * "message": "Role (manager) Deleted Successfully."
 * }
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\DeleteRoleController;
use Illuminate\Support\Facades\Route;

Route::delete('roles/{id}', [DeleteRoleController::class, 'deleteRole'])
    ->middleware(['auth:api']);
