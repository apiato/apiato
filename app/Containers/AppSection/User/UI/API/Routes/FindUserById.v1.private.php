<?php

/**
 * @apiGroup           User
 * @apiName            findUserById
 * @api                {get} /v1/users/:id Find User
 * @apiDescription     Find a user by its ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\FindUserByIdController;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}', [FindUserByIdController::class, 'findUserById'])
    ->name('api_user_find_user')
    ->middleware(['auth:api']);
