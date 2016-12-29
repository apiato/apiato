<?php

/**
 * @apiGroup           Users
 * @apiName            ListAllUsers
 * @api                {get} /users Search & List all Users
 * @apiDescription     List all the Application Users. You can search for Users
 * by email, name and ID
 * Example: `?search=Mahmoud` or `?search=whatever@mail.com`.
 * You can specify the field as follow `?search=email:whatever@mail.com` or `?search=id:20`.
 * You can search by multiple fields as follow: `?search=name:Mahmoud&email:whatever@mail.com`.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer {User-Token} (required)
 *
 * @apiParam           search           ?search=name:John Doe;email:john@mail.com (optional)
 * @apiParam           searchFields     ?searchFields=name:like;email:= (optional)
 * @apiParam           paginate         ?page=3 (optional)
 * @apiParam           order            ?orderBy=id (optional)
 * @apiParam           sort             ?sortedBy=asc (optional)
 * @apiParam           filter           ?filter=id;name;age (optional)
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
         "visitor_id":null,
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
         "visitor_id":null,
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
         "visitor_id":null,
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
        'api.auth',
    ],
]);
