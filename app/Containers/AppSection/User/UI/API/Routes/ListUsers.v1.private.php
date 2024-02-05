<?php

/**
 * @apiGroup           User
 *
 * @apiName            ListUsers
 *
 * @api                {get} /v1/users List All Users
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null] | Resource Owner
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiUse             UserSuccessMultipleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\ListUsersController;
use Illuminate\Support\Facades\Route;

Route::get('users', ListUsersController::class)
    ->middleware(['auth:api']);
