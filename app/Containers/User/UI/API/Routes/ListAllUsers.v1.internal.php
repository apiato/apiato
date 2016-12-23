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
 * @apiPermission      Authenticated Admin
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
HTTP/1.1 200 OK
{
{
   "data":[
      {
         "id":0,
         "name":"Nola Mayer",
         "email":"candice86@hotmail.com",
         "confirmed":"0",
         "total_credits":0,
         "created_at":{
            "date":"2016-12-23 19:48:53.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "token":null,
         "updated_at":{
            "date":"2016-12-23 19:48:53.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "deleted_at":null,
         "roles":{
            "data":[

            ]
         }
      },
      {
         "id":0,
         "name":"Aditya Nitzsche",
         "email":"sauer.sammy@hotmail.com",
         "confirmed":"0",
         "total_credits":0,
         "created_at":{
            "date":"2016-12-23 19:48:53.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "token":null,
         "updated_at":{
            "date":"2016-12-23 19:48:53.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "deleted_at":null,
         "roles":{
            "data":[

            ]
         }
      },
      {
         "id":0,
         "name":"Margot Donnelly",
         "email":"antonio20@yahoo.com",
         "confirmed":"0",
         "total_credits":0,
         "created_at":{
            "date":"2016-12-23 19:48:53.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "token":null,
         "updated_at":{
            "date":"2016-12-23 19:48:53.000000",
            "timezone_type":3,
            "timezone":"UTC"
         },
         "deleted_at":null,
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
}
 */

$router->get('users', [
    'uses'       => 'Controller@listAllUsers',
    'middleware' => [
        'api.auth',
        'role:admin'
    ],
]);
