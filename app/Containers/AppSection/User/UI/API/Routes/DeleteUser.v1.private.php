<?php

/**
 * @apiGroup           User
 *
 * @apiName            DeleteUser
 *
 * @api                {delete} /v1/users/:id Delete User
 *
 * @apiDescription     Delete users of any type (Admin, Client...)
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
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 204 No Content
 * {}
 */

use App\Containers\AppSection\User\UI\API\Controllers\DeleteUserController;
use Illuminate\Support\Facades\Route;

Route::delete('users/{id}', DeleteUserController::class)
    ->middleware(['auth:api']);
