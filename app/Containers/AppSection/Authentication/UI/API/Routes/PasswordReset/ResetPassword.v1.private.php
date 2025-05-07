<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            ResetPassword
 *
 * @api                {post} /v1/reset-password Reset Password
 *
 * @apiDescription     Resets the password of the user.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Guest
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody            {String} token from the forgot password email
 * @apiBody            {String} email
 * @apiBody            {String} password min: 8
 *
 * at least one character of the following:
 *
 * upper case letter
 *
 * lower case letter
 *
 * number
 *
 * special character
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::post('reset-password', ResetPasswordController::class)
    ->middleware('guest')
    ->name('password.update');
