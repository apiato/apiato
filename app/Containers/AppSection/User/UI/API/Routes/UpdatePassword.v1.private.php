<?php

/**
 * @apiGroup           User
 *
 * @apiName            UpdatePassword
 *
 * @api                {patch} /v1/users/:user_id/password Update User's Password
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null] | Resource Owner
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} user_id
 *
 * @apiBody            {String} current_password
 * @apiBody            {String} new_password min: 8
 * @apiBody            {String} new_password_confirmation same:new_password
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

use App\Containers\AppSection\User\UI\API\Controllers\UpdatePasswordController;
use Illuminate\Support\Facades\Route;

Route::patch('users/{user_id}/password', UpdatePasswordController::class)
    ->middleware(['auth:api']);
