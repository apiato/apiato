<?php

/**
 * @apiGroup           User
 *
 * @apiName            FindUserById
 *
 * @api                {get} /v1/users/:user_id Find User
 *
 * @apiDescription     Find a user by its id
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} user_id
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\FindUserByIdController;
use Illuminate\Support\Facades\Route;

Route::get('users/{user_id}', FindUserByIdController::class)
    ->middleware(['auth:api']);
