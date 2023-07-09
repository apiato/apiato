<?php

/**
 * @apiGroup           OAuth2
 *
 * @apiName            LoginProxyForWebClient
 *
 * @api                {post} /v1/clients/web/login Login (Password Grant with proxy)
 *
 * @apiDescription     Login Users using their email and password, without client_id and client_secret.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody           {String} email
 * @apiBody           {String} password
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

use App\Containers\AppSection\Authentication\UI\API\Controllers\LoginProxyForWebClientController;
use Illuminate\Support\Facades\Route;

Route::post('clients/web/login', LoginProxyForWebClientController::class);
