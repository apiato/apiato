<?php

/**
 * @apiGroup           RolePermission
 * @apiName            GetAllPermissions
 * @api                {get} /v1/permissions Get All Permission
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => '']
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\GetAllPermissionsController;
use Illuminate\Support\Facades\Route;

Route::get('permissions', [GetAllPermissionsController::class, 'getAllPermissions'])
    ->middleware(['auth:api']);
