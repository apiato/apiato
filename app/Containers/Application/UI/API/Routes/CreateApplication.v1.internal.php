<?php

/*********************************************************************************
 * @apiGroup           Applications
 * @apiName            createApplicationWithToken
 * @api                {post} /apps Create App Token
 * @apiDescription     Create an Application and gain access to our server on behalf
 *                     of your user from your third party App.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User (with Developer role)
 *
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 *
 * @apiParam           {string} Name (required) Application Name
 *
 * @apiSuccessExample  {json}       Success-Response:
* HTTP/1.1 200 OK
{
   "data":{
      "object":"Application",
      "id":"owpmaymq",
      "name":"My first App",
      "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
      "created_at":{
         "date":"2016-12-22 17:55:34.000000",
         "timezone_type":3,
         "timezone":"UTC"
      }
   }
}
 */

$router->post('apps', [
    'uses'       => 'Controller@createApplication',
    'middleware' => [
        'api.auth',
        'role:developer',
    ],
]);
