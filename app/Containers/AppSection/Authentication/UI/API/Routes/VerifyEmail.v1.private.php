<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            VerifyEmail
 *
 * @api                {POST} /v1/email/verify/:id/:hash Verify Email
 *
 * @apiDescription     Verify user email
 *
 * Example of a verification email link sent to the user which is used to verify the user `http://apiato.test/email/verify?url=http://api.apiato.test/v1/email/verify/XbPW7awNkzl83LD6/eaabd911e2e07ede6456d3bd5725c6d4a5c2dc0b?expires=1646913047&signature=232702865b8353c445b39c50397e66db33c74df80e3db5a7c0d46ef94c8ab6a9`
 *
 * Value of `url` query string in the verification link above (sent to the user by email) can be directly used to call the api to verify the user.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiParam           {String} id user id
 * @apiParam           {String} hash a hashed value sent to the user email
 *
 * @apiQuery           {string} expires expiration time of the `verify email` link
 * @apiQuery           {string} signature a signature to check the validity of the `verify email` link
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 200 OK
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post('email/verify/{id}/{hash}', VerifyEmailController::class)
    ->name('verification.verify')
    ->middleware('signed');
