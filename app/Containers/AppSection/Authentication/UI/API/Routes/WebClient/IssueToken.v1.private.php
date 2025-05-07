<?php

/**
 * @apiGroup           OAuth2
 *
 * @apiName            IssueToken (Web Client)
 *
 * @api                {post} /v1/clients/web/login Login (Password Grant with proxy)
 *
 * @apiDescription     Login Users using their email and password
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody            {String} email
 * @apiBody            {String} password
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "token_type": "Bearer",
 * "expires_in": 315360000,
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
 * "refresh_token": "ZFDPA1S7H8Wydjkjl+xt+hPGWTagX..."
 * }
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\WebClient\IssueTokenController;
use Illuminate\Support\Facades\Route;

Route::post('clients/web/login', IssueTokenController::class);
