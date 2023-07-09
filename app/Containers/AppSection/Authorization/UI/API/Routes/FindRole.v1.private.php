<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            GetRole
 *
 * @api                {get} /v1/roles/:id Find a Role by ID
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id role id
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\FindRoleController;
use Illuminate\Support\Facades\Route;

Route::get('roles/{id}', FindRoleController::class)
    ->middleware(['auth:api']);
