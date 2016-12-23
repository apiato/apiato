<?php

/**
 * @apiGroup           Users
 * @apiName            registerUser
 * @api                {post} /user/register Register User
 * @apiDescription     If the App supports Visitors Access (allows users to use)
 * the App first and register later) then you `must` send the `visitor-id` in the
 * header. If the app require registering first, with no access to Visitors, then
 * you can just pass the user info without the `visitor-id`.
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
      "visitor_id":null,
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
 */

$router->post('user/register', [
    'uses'  => 'Controller@registerUser',
]);
