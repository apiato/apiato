<?php

/**
 * @apiGroup           Users
 * @apiName            CreateAdmin
 * @api                {post} /v1/admins Create Admin User
 * @apiDescription     Creating User with Role Admin, form the Dashboard.
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  password
 * @apiParam           {String}  name
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "id":sdfgdhf,
      "name":"Mahmoud Zalt",
      "email":"testing@whatever.dev",
      "confirmed":"0",
      "total_credits":0,
      "created_at":{
         "date":"2016-12-23 19:51:11.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "token":null,
      "roles":{
         "data":[
            {
               "name":"Admin",
               "description":null
            }
         ]
      }
   }
}
 */

$router->post('admins', [
    'uses'  => 'Controller@createAdmin',
    'middleware' => [
      'auth:api',
    ],
]);
