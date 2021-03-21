<?php

/**
 * @apiGroup           Users
 * @apiName            updateUser
 * @api                {put} /v1/users/:id Update User
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  password (optional)
 * @apiParam           {String}  name (optional)
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('users/{id}', [Controller::class, 'updateUser'])
    ->name('api_user_update_user')
    ->middleware(['auth:api']);
