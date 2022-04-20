<?php

/**
 * @apiGroup           User
 * @apiName            UpdateUserPassword
 * @api                {patch} /v1/users/:id Update User's Password
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'update-users', 'roles' => ''] | Resource Owner
 *
 * @apiParam           {String} current_password
 * @apiParam           {String} new_password min: 8
 *
 * at least one character of the following:
 *
 * upper case letter
 *
 * lower case letter
 *
 * number
 *
 * special character
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\UpdateUserPasswordController;
use Illuminate\Support\Facades\Route;

Route::patch('users/{id}/password', [UpdateUserPasswordController::class, 'updateUserPassword'])
    ->middleware(['auth:api']);
