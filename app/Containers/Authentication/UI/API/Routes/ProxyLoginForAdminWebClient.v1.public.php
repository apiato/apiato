<?php

/**
 * @apiGroup           OAuth2
 * @apiName            ClientAdminWebAppLoginProxy
 * @api                {post} /v1/clients/web/admin/login Login (Password Grant)
 * @apiDescription     Login Users using their username and passwords. (For First-Party Clients)
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
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
  "refresh_token": "Oukd61zgKzt8TBwRjnasd..."
}
 */
$router->post('clients/web/admin/login', [
    'uses'  => 'Controller@proxyLoginForAdminWebClient',
]);
