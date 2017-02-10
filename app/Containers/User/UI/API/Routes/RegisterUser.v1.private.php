<?php

/**
 * @apiGroup           Users
 * @apiName            registerUser
 * @api                {post} /users/register Register User
 * @apiDescription
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiHeader          Accept application/json (required)
 *
 * @apiParam           {String}  email (required)
 * @apiParam           {String}  password (required)
 * @apiParam           {String}  name (optional)
 * @apiParam           {String}  gender (optional)
 * @apiParam           {String}  birth (optional)
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "id":0,
      "name":"Mahmoud Zalt",
      "email":"hello@mail.dev",
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
    "token": {
      "object": "token",
      "token": null,
      "access_token": {
        "token_type": "Bearer",
        "time_to_live": {
          "minutes": 60
        },
        "expires_in": {
          "date": "2017-02-10 23:43:41.668135",
          "timezone_type": 3,
          "timezone": "UTC"
        }
      }
    },
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

$router->post('users/register', [
    'uses'  => 'Controller@registerUser',
]);
