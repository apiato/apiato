<?php

/**
 * @apiGroup           Authentication
 * @apiName            UserLogin
 * @api                {post} /user/login Login a user
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiHeader          Accept application/json (required)
 *
 * @apiParam           {String}     email (required)
 * @apiParam           {String}     password (required)
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "id":0,
      "name":"Hello",
      "email":"hello@mail.dev",
      "confirmed":"0",
      "total_credits":0,
      "created_at":{
         "date":"2016-12-22 18:14:43.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
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
 *
 * @apiErrorExample  {json}       Error-Response:
{
   "message":"401 Credentials Incorrect.",
   "status_code":401
}
 *
 * @apiErrorExample  {json}       Error-Response:
{
   "message":"Invalid Input.",
   "errors":{
      "email":[
         "The email field is required."
      ]
   },
   "status_code":422
}
 */

$router->post('user/login', [
    'uses' => 'Controller@userLogin',
]);
