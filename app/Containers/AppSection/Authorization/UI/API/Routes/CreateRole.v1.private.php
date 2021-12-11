<?php

/**
 * @apiGroup           RolePermission
 * @apiName            CreateRole
 * @api                {post} /v1/roles Create a Role
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => '']
 *
 * @apiParam           {String} name Unique Role Name
 * @apiParam           {String} [description]
 * @apiParam           {String} [display_name]
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\CreateRoleController;
use Illuminate\Support\Facades\Route;

Route::post('roles', [CreateRoleController::class, 'createRole'])
    ->middleware(['auth:api']);
