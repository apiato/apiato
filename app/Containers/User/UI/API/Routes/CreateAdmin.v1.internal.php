<?php

/**
 * @apiGroup           Users
 * @apiName            createAdmin
 * @api                {post} /admins/create Create Admin
 * @apiDescription     Creating Admins form the Dashboard
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiHeader          Accept application/json
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
      "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
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

$router->post('admins/create', [
    'uses'  => 'Controller@createAdmin',
    'middleware' => [
      'api.auth',
    ],
]);
