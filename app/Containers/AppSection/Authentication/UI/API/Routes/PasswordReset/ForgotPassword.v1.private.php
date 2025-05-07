<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            ForgotPassword
 *
 * @api                {post} /v1/forgot-password Forgot password
 *
 * @apiDescription     Forgot password
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Guest
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody            {String}  email
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 202 Accepted
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::post('forgot-password', ForgotPasswordController::class)
    ->middleware('guest')
    ->name('password.email');
