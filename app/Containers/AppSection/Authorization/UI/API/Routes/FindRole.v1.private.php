<?php

/**
 * @apiGroup           RolePermission
 * @apiName            getRole
 * @api                {get} /v1/roles/:id Find a Role by ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\FindRoleController;
use Illuminate\Support\Facades\Route;

Route::get('roles/{id}', [FindRoleController::class, 'findRole'])
    ->name('api_authorization_get_role')
    ->middleware(['auth:api']);
