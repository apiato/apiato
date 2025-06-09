<?php

declare(strict_types=1);

/**
 * @apiGroup           RolePermission
 *
 * @apiName            ListPermissions
 *
 * @api                {get} /v1/permissions List all permissions
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiUse             PermissionSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\ListPermissionsController;
use Illuminate\Support\Facades\Route;

Route::get('permissions', ListPermissionsController::class)
    ->middleware(['auth:api']);
