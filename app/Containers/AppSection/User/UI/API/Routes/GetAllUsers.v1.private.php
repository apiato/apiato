<?php

/**
 * @apiGroup           User
 *
 * @apiName            GetAllUsers
 *
 * @api                {get} /v1/users Get All Users
 *
 * @apiDescription     Get All Application Users (clients and admins). For all registered users "Clients" only you
 *                     can use `/clients`. And for all "Admins" only you can use `/admins`.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'list-users', 'roles' => ''] | Resource Owner
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiUse             UserSuccessMultipleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\GetAllUsersController;
use Illuminate\Support\Facades\Route;

Route::get('users', GetAllUsersController::class)
    ->middleware(['auth:api']);
