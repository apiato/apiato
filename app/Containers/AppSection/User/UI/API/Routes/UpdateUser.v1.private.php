<?php

/**
 * @apiGroup           User
 *
 * @apiName            UpdateUser
 *
 * @api                {patch} /v1/users/:id Update User
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null] | Resource Owner
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id user id
 *
 * @apiBody           {String} [name] min:2|max:50
 * @apiBody           {String="male","female","unspecified"} [gender]
 * @apiBody           {Date} [birth] format: Y-m-d / e.g. 2015-10-15
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::patch('users/{id}', UpdateUserController::class)
    ->middleware(['auth:api']);
