<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            FindPermissionById
 *
 * @api                {get} /v1/permissions/:id Find a Permission by ID
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id permission id
 *
 * @apiUse             PermissionSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\FindPermissionByIdController;
use Illuminate\Support\Facades\Route;

Route::get('permissions/{id}', FindPermissionByIdController::class)
    ->middleware(['auth:api']);
