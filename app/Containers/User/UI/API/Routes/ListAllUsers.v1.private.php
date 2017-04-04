<?php

/**
 * @apiGroup           Users
 * @apiName            ListAllUsers
 * @api                {get} /users List All Users
 * @apiDescription     List all Application Users of any roles. For listing all registered users "Clients" only you
 *                     can use `/clients`. And for listing all Admins (users of role Admin) only you can use `/admins`.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 200 OK
{
   "data":[
      {
         "id":0,
         "name":"Reyes Anderson",
         "email":"jaden.runolfsdottir@hermann.com",
         "confirmed":"0",
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
            "date":"2016-12-23 20:05:13.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "token":null,
         "roles":{
            "data":[

            ]
         }
      },
      {
         "id":0,
         "name":"Prudence Murazik",
         "email":"maxie.rempel@yahoo.com",
         "confirmed":"0",
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
            "date":"2016-12-23 20:05:13.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "token":null,
         "roles":{
            "data":[

            ]
         }
      },
      {
         "id":0,
         "name":"Lisa Roob",
         "email":"ladarius02@runte.info",
         "confirmed":"0",
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
            "date":"2016-12-23 20:05:13.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "token":null,
         "roles":{
            "data":[

            ]
         }
      },
      ...
   ],
   "meta":{
      "pagination":{
         "total":16,
         "count":16,
         "per_page":30,
         "current_page":1,
         "total_pages":1,
         "links":[

         ]
      }
   }
}
 */

$router->get('users', [
    'uses'       => 'Controller@listAllUsers',
    'middleware' => [
        'auth:api',
    ],
]);
