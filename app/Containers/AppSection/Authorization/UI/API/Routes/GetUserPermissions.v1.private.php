<?php

/**
 * @apiGroup           RolePermission
 * @apiName            GetUserPermissions
 *
 * @api                {GET} /v1/users/:id/permissions Get User Permissions
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id id of user
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\GetUserPermissionsController;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}/permissions', [GetUserPermissionsController::class, 'getUserPermissions'])
    ->middleware(['auth:api']);

