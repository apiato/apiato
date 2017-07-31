<?php

/**
 * @apiGroup           OAuth2
 * @apiName            ClientAdminWebAppRefreshProxy
 * @api                {post} /v1/clients/web/admin/refresh Refresh
 * @apiDescription     Refresh access token based on refreshToken http cookie.
 *
 * @apiVersion         1.0.0
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
  "token_type": "Bearer",
  "expires_in": 315360000,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbG..."
}
 */
$router->post('clients/web/admin/refresh', [
    'uses'  => 'Controller@proxyRefreshForAdminWebClient',
]);
