<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            ForgotPassword
 *
 * @api                {POST} /v1/password/forgot Forgot password
 *
 * @apiDescription     Forgot password endpoint.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody           {String}  email
 * @apiBody           {String="reset-password"}  reseturl the reset password url
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 No Content
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::post('password/forgot', ForgotPasswordController::class);
