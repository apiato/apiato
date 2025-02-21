<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            SendVerificationEmail
 *
 * @api                {post} /v1/email/verification-notification Send Verification Email
 *
 * @apiDescription     Send verification email to the currently authenticated user
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => null, 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 202 Accepted
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\SendController;
use Illuminate\Support\Facades\Route;

Route::post('/email/verification-notification', SendController::class)
    ->middleware(['auth:api', 'throttle:6,1'])
    ->name('verification.send');
