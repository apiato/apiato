<?php

/**
 * @apiGroup           Authentication
 * @apiName            ResetPassword
 *
 * @api                {GET/POST} /v1/password/reset Reset Password
 * @apiDescription     Resets a password for an user.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  token from the forgot password email
 * @apiParam           {String}  password min:6|max:255 the new password
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 No Content
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::any('password/reset', [ResetPasswordController::class, 'resetPassword']);
