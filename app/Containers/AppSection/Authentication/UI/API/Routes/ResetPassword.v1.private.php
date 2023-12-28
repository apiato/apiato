<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            ResetPassword
 *
 * @api                {post} /v1/password/reset Reset Password
 *
 * @apiDescription     Resets password of a user.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody           {String} email
 * @apiBody           {String} token from the forgot password email
 * @apiBody           {String} password min: 8
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
 * HTTP/1.1 204 No Content
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::post('password/reset', ResetPasswordController::class);
