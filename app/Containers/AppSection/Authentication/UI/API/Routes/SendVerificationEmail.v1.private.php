<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            SendVerificationEmail
 *
 * @api                {POST} /v1/email/verification-notification Send Verification Email
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
 * @apiBody           {String} verification_url required|url
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 202 Accepted
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\SendVerificationEmailController;
use Illuminate\Support\Facades\Route;

Route::post('/email/verification-notification', SendVerificationEmailController::class)
    ->middleware(['auth:api']);
