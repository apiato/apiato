<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            FindPermissionById
 *
 * @api                {get} /v1/permissions/:permission_id Find a permission by id
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} permission_id
 *
 * @apiUse             PermissionSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\FindPermissionByIdController;
use Illuminate\Support\Facades\Route;

Route::get('permissions/{permission_id}', FindPermissionByIdController::class)
    ->middleware(['auth:api']);
