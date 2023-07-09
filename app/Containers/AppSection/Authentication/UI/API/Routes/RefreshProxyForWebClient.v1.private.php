<?php

/**
 * @apiGroup           OAuth2
 *
 * @apiName            RefreshProxyForWebClient
 *
 * @api                {post} /v1/clients/web/refresh Refresh
 *
 * @apiDescription     Get new tokens given a valid refresh token is provided.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody           {String}  [refresh_token] The refresh Token
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

use App\Containers\AppSection\Authentication\UI\API\Controllers\RefreshProxyForWebClientController;
use Illuminate\Support\Facades\Route;

Route::post('clients/web/refresh', RefreshProxyForWebClientController::class);
