<?php

/**
 * @apiGroup           Users
 * @apiName            UpdateUser
 * @api                {put} /users Update User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer {User-Token} (required)
 *
 * @apiParam           {String}  password
 * @apiParam           {String}  name
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "id":0,
      "name":"Mahmoud Zalt",
      "email":"testing@whatever.dev",
      "confirmed":"0",
      "total_credits":0,
      "created_at":{
         "date":"2016-12-23 19:51:11.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
      "roles":{
         "data":[
            {
               "name":"Developer",
               "description":null
            },
            {
               "name":"Client User",
               "description":null
            }
         ]
      }
   }
}
 */

$router->put('users', [
    'uses'       => 'Controller@updateUser',
    'middleware' => [
        'api.auth',
    ],
]);
