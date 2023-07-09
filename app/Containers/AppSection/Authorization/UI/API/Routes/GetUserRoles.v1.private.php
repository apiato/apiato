<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            GetUserRoles
 *
 * @api                {GET} /v1/users/:id/roles Get User Roles
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id user id
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\GetUserRolesController;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}/roles', GetUserRolesController::class)
    ->middleware(['auth:api']);
