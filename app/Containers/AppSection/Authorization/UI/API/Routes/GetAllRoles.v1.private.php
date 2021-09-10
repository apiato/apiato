<?php

/**
 * @apiGroup           RolePermission
 * @apiName            getAllRoles
 * @api                {get} /v1/roles Get All Roles
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\GetAllRolesController;
use Illuminate\Support\Facades\Route;

Route::get('roles', [GetAllRolesController::class, 'getAllRoles'])
    ->name('api_authorization_get_all_roles')
    ->middleware(['auth:api']);
