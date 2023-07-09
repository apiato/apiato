<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            GetAuthenticatedUser
 *
 * @api                {GET} /v1/profile Get Profile
 *
 * @apiDescription     Find the user details of the logged-in user from its Token. (without specifying his ID)
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\GetAuthenticatedUserController;
use Illuminate\Support\Facades\Route;

Route::get('profile', GetAuthenticatedUserController::class)
    ->middleware(['auth:api']);
