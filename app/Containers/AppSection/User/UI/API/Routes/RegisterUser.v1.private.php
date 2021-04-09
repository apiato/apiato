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
 * @apiParam           {String}  password
 * @apiParam           {String}  [name]
 * @apiParam           {String}  [gender]
 * @apiParam           {String}  [birth]
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('/register', [Controller::class, 'registerUser'])
    ->name('api_user_register_user');
