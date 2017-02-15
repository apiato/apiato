<?php

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            getUser
 * @api                {get} /users/:id Get User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer {User-Token}
 *
 * @apiParam           search           ?search=field1:text here;field2:text here
 * @apiParam           searchFields     ?searchFields=field1:like;field2:=
 * @apiParam           paginate         ?page=3
 * @apiParam           order            ?orderBy=id
 * @apiParam           sort             ?sortedBy=asc
 * @apiParam           filter           ?filter=field1;field2;field3
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
        'app.auth',
    ],
]);
