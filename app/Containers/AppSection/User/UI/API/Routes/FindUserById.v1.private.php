<?php

/**
 * @apiGroup           User
 *
 * @apiName            FindUserById
 *
 * @api                {get} /v1/users/:id Find User
 *
 * @apiDescription     Find a user by its ID
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id user id
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\FindUserByIdController;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}', FindUserByIdController::class)
    ->middleware(['auth:api']);
