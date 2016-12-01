<?php

/*********************************************************************************
 * @apiGroup           Applications
 * @apiName            createApplicationWithToken
 * @api                {post} /apps Create App Token
 * @apiDescription     Create an Application and gain access to our server on behalf
 *                     of your user from your third party App.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User (with Developer role)
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParam           {string} Name (required) Application Name
 * @apiSuccessExample  {json}       Success-Response:
* HTTP/1.1 202 Accepted
{
  "application_name": "My App",
  "application_id": 25,
  "application_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
}
 */
$router->post('apps', [
    'uses'       => 'Controller@createApplication',
    'middleware' => [
        'api.auth',
        'role:developer',
    ],
]);
