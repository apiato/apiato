<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            FindRoleById
 *
 * @api                {get} /v1/roles/:role_id Find a role by id
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
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\FindRoleByIdController;
use Illuminate\Support\Facades\Route;

Route::get('roles/{role_id}', FindRoleByIdController::class)
    ->middleware(['auth:api']);
