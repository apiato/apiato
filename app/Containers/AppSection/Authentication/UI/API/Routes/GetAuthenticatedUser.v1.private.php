<?php

/**
 * @apiGroup           Authentication
 * @apiName            GetAuthenticatedUser
 *
 * @api                {GET} /v1/profile Find Logged-in User data (Profile Information)
 * @apiDescription     Find the user details of the logged-in user from its Token. (without specifying his ID)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\GetAuthenticatedUserController;
use Illuminate\Support\Facades\Route;

Route::get('profile', [GetAuthenticatedUserController::class, 'getAuthenticatedUser'])
    ->middleware(['auth:api']);
