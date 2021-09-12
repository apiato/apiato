<?php

/**
 * @apiGroup           User
 * @apiName            registerUser
 * @api                {post} /v1/register Register User (create client)
 * @apiDescription     Register users as (client).
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  password min:6|max:40
 * @apiParam           {String}  [name] min:2|max:50
 * @apiParam           {String="male,female,unspecified"}  [gender]
 * @apiParam           {Date}  [birth] format: Y-m-d / e.g. 2015-10-15
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterUserController::class, 'registerUser'])
    ->name('api_user_register_user');
