<?php

/**
 * @apiGroup           Users
 * @apiName            UpdateUser
 * @api                {put} /v1/users Update User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  password (optional)
 * @apiParam           {String}  name (optional)
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "id":0,
      "name":"Mahmoud Zalt",
      "email":"apiato@mail.dev",
      "confirmed":null,
      "nickname":null,
      "gender":null,
      "birth":null,
      "social_auth_provider":null,
      "social_id":null,
      "social_avatar":{
         "avatar":null,
         "original":null
      },
      "created_at":{
         "date":"2016-12-23 20:01:34.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "token":null,
      "roles":{
         "data":[
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
        'auth:api',
    ],
]);
