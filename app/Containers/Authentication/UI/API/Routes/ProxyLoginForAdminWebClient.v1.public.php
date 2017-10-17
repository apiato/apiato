<?php

/**
 * @apiGroup           OAuth2
 * @apiName            ClientAdminWebAppLoginProxy
 * @api                {post} /v1/clients/web/admin/login Login (Password Grant with proxy)
 * @apiDescription     Login Users using their email and password, without client_id and client_secret.
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {String}  email user email
 * @apiParam           {String}  password user password
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
  "token_type": "Bearer",
  "expires_in": 315360000,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
  "refresh_token": "ZFDPA1S7H8Wydjkjl+xt+hPGWTagX..."
}
 */
$router->post('clients/web/admin/login', [
    'as' => 'api_authentication_client_admin_web_app_login_proxy',
    'uses'  => 'Controller@proxyLoginForAdminWebClient',
]);
