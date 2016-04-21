<?php

/*********************************************************************************
 * @apiGroup           User
 * @apiName            Login
 * @api                {post} /login Login a user
 * @apiDescription     Login existing User
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiUse             Headers_Normal
 * @apiParam           {String}     email
 * @apiParam           {String}     password
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 200 OK

{
  "data": {
    "id": 1,
    "name": "Mahmoud Zalt",
    "email": "mahmoud@zalt.me",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsIm..."
    "created_at": {
      "date": "2016-04-09 02:34:11.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-04-09 02:34:11.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
}
 */
$router->post('login', [
    'uses' => 'LoginController@handle'
]);

/*********************************************************************************
 * @apiGroup           User
 * @apiName            Logout
 * @api                {post} /logout Logout a user
 * @apiDescription     Logout an Authenticated User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiUse             Headers_Authenticated
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 202 Accepted
 */
$router->post('logout', [
    'uses'       => 'LogoutController@handle',
    'middleware' => [
        'api.auth',
    ]
]);

/*********************************************************************************
 * @apiGroup           User
 * @apiName            RegisterUser
 * @api                {post} /register Register new User
 * @apiDescription     Create and Login new user
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiUse             Headers_Normal
 * @apiParam           {String}  email
 * @apiParam           {String}  password
 * @apiParam           {String}  name
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK

{
  "data": {
    "id": 1,
    "name": "Mahmoud Zalt",
    "email": "mahmoud@zalt.me",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsIm..."
    "created_at": {
      "date": "2016-04-09 02:34:11.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-04-09 02:34:11.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
}
 */
$router->post('register', [
    'uses' => 'RegisterController@handle'
]);

/*********************************************************************************
 * @apiGroup           User
 * @apiName            ListAllUsers
 * @api                {get} /users Search & List all Users
 * @apiDescription     List all the Application Users
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
 * @apiUse             Headers_Authenticated
 * @apiParam           search           ?search=name:John Doe;email:john@main.com
 * @apiParam           searchFields     ?searchFields=name:like;email:=
 * @apiParam           paginate         ?page=3
 * @apiParam           order            ?orderBy=id
 * @apiParam           sort             ?sortedBy=asc
 * @apiParam           filter           ?filter=id;name;age
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK

 {
  "data": [
    {
      "id": 2,
      "name": "Mahmoud Zalt",
      "email": "mahmoud@zalt.me",
      "token": null,
      "created_at": {
        "date": "2016-04-12 06:15:06.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "updated_at": {
        "date": "2016-04-12 06:15:06.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      }
    },
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@something.com",
      "token": null,
      "created_at": {
        "date": "2016-04-09 02:34:11.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      },
      "updated_at": {
        "date": "2016-04-09 02:34:11.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      }
    }
  ],
  "meta": {
    "pagination": {
      "total": 25,
      "count": 10,
      "per_page": 10,
      "current_page": 1,
      "total_pages": 1,
      "links": []
    }
  }
}
 */
$router->get('users', [
    'uses'       => 'ListAllUsersController@handle',
    'middleware' => [
        'api.auth',
    ]
]);


/*********************************************************************************
 * @apiGroup           User
 * @apiName            UpdateUser
 * @api                {PATCH} /users/{id} Update a User
 * @apiDescription     Update User details
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiUse             Headers_Authenticated
 */
$router->patch('users/{id}', [
    'uses'       => 'UpdateUserController@handle',
    'middleware' => [
        'api.auth',
    ]
]);
