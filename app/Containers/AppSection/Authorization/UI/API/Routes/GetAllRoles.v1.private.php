<?php

/**
 * @apiGroup           RolePermission
 * @apiName            GetAllRoles
 * @api                {get} /v1/roles Get All Roles
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => '']
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\GetAllRolesController;
use Illuminate\Support\Facades\Route;

Route::get('roles', [GetAllRolesController::class, 'getAllRoles'])
    ->middleware(['auth:api']);
