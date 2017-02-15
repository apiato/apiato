<?php

/**
 * @apiGroup           Users
 * @apiName            RefreshUser
 * @api                {post} /users/{id}/refresh Refresh User data
 * @apiDescription     Request the latest user Data. You can send the
 * `token` header or `user_id` parameter to get the updated user data.
 * (You can use this Endpoint whenever the user object is updated for any reason to get
 * his updated data).
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json
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
      "token":null,
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

$router->post('users/{id}/refresh', [
    'uses' => 'Controller@refreshUser',
    'middleware' => [
        'api.auth',
    ],
]);
