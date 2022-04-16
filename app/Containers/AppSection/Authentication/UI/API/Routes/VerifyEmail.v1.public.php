<?php

/**
 * @apiGroup           Authentication
 * @apiName            VerifyEmail
 *
 * @api                {POST} /v1/email/verify/:id/:hash Verify Email
 * @apiDescription     Verify user email
 *
 * Value of `url` query string in the verification link (sent to the user by email) should be directly used to call the api and verify the user
 *
 * example of a verification email link sent to the user which is used to verify the use `http://apiato.test/email/verify?url=http://api.apiato.test/v1/email/verify/XbPW7awNkzl83LD6/eaabd911e2e07ede6456d3bd5725c6d4a5c2dc0b?expires=1646913047&signature=232702865b8353c445b39c50397e66db33c74df80e3db5a7c0d46ef94c8ab6a9`
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 200 OK
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post('email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyEmail'])
    ->name('verification.verify')
    ->middleware('signed');
