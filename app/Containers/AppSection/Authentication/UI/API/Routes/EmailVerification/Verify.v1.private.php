<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            VerifyEmail
 *
 * @api                {post} /v1/email/verify/:id/:hash Verify Email
 *
 * @apiDescription     Verify user email by passing the user id and hash.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'null', 'roles' => null]
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiParam           {String} id The user id
 * @apiParam           {String} hash The hash is sha1 of the user email
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 200 OK
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\VerifyController;
use Illuminate\Support\Facades\Route;

Route::post('email/verify/{id}/{hash}', VerifyController::class)
    ->middleware(['auth:api', 'signed'])
    ->name('verification.verify');
