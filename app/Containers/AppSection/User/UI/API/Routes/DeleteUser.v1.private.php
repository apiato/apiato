<?php

/**
 * @apiGroup           User
 * @apiName            DeleteUser
 * @api                {delete} /v1/users/:id Delete User
 * @apiDescription     Delete users of any type (Admin, Client...)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
 * {
 * "message": "User (4) Deleted Successfully."
 * }
 */

use App\Containers\AppSection\User\UI\API\Controllers\DeleteUserController;
use Illuminate\Support\Facades\Route;

Route::delete('users/{id}', [DeleteUserController::class, 'deleteUser'])
    ->middleware(['auth:api']);
