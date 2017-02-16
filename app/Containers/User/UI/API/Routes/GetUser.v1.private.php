<?php

/**
 * @apiGroup           Users
 * @apiName            getUser
 * @api                {get} /users/:id Get User
 * @apiDescription     Find a user by its ID
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
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
      "token": null,
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

$router->get('users/{id}', [
    'uses'       => 'Controller@getUser',
    'middleware' => [
        'api.auth',
    ],
]);
