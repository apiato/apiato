<?php

/**
 * @apiGroup           User
 * @apiName            UpdateUser
 * @api                {patch} /v1/users/:id Update User
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'update-users', 'roles' => ''] | Resource Owner
 *
 * @apiParam           {String} [password] min:6|max:40
 * @apiParam           {String} [name] min:2|max:50
 * @apiParam           {String="male,female,unspecified"} [gender]
 * @apiParam           {Date} [birth] format: Y-m-d / e.g. 2015-10-15
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::patch('users/{id}', [UpdateUserController::class, 'updateUser'])
    ->middleware(['auth:api']);
