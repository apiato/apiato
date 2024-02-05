<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            CreateRole
 *
 * @api                {post} /v1/roles Create a Role
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody           {String} name Unique Role Name
 * @apiBody           {String} [description]
 * @apiBody           {String} [display_name]
 * @apiBody           {String="api","web"} [guard_name] Default: api
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\CreateRoleController;
use Illuminate\Support\Facades\Route;

Route::post('roles', CreateRoleController::class)
    ->middleware(['auth:api']);
