<?php

/**
 * @apiGroup           User
 *
 * @apiName            UpdateUser
 *
 * @api                {patch} /v1/users/:user_id Update User
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
 * @apiBody            {String} [name] min:2|max:50
 * @apiBody            {String="male","female","unspecified"} [gender]
 * @apiBody            {Date} [birth] format: Y-m-d / e.g. 2015-10-15
 * @apiBody            {String} current_password
 * @apiBody            {String} new_password min: 8
 * @apiBody            {String} new_password_confirmation same:new_password
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::patch('users/{user_id}', UpdateUserController::class)
    ->middleware(['auth:api']);
