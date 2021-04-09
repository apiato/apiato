<?php

/**
 * @apiGroup           User
 * @apiName            resetPassword
 *
 * @api                {GET/POST} /v1/password/reset Reset Password
 * @apiDescription     Resets a password for an user.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  token from the forgot password email
 * @apiParam           {String}  password the new password
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 OK
 * {}
 */

use App\Containers\AppSection\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::any('password/reset', [Controller::class, 'resetPassword'])
    ->name('api_user_reset_password');
