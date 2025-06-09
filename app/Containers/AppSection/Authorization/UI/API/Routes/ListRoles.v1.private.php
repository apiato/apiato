<?php

declare(strict_types=1);

/**
 * @apiGroup           RolePermission
 *
 * @apiName            ListRoles
 *
 * @api                {get} /v1/roles List all roles
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiUse             RoleSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\ListRolesController;
use Illuminate\Support\Facades\Route;

Route::get('roles', ListRolesController::class)
    ->middleware(['auth:api']);
