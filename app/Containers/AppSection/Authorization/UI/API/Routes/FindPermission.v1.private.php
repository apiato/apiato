<?php

/**
 * @apiGroup           RolePermission
 * @apiName            GetPermission
 * @api                {get} /v1/permissions/:id Find a Permission by ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             PermissionSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\FindPermissionController;
use Illuminate\Support\Facades\Route;

Route::get('permissions/{id}', [FindPermissionController::class, 'findPermission'])
    ->middleware(['auth:api']);
