<?php

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            Login
 * @api                {post} /login Login a user
 * @apiDescription     Login existing User
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json
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
    'uses' => 'Controller@loginUser',
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            Logout
 * @api                {post} /logout Logout a user
 * @apiDescription     Logout an Authenticated User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept   application/json
 * @apiHeader          Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ91QiLCJhbGciOiJIUzI1NiJ1...
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 202 Accepted
 */
$router->post('logout', [
    'uses'       => 'Controller@logoutUser',
    'middleware' => [
        'api.auth',
    ],
]);


/*********************************************************************************
 * @apiGroup           Users
 * @apiName            UpdateUser
 * @api                {put} /users/{id} Update a User
 * @apiDescription     Update User details
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ91QiLCJhbGciOiJIUzI1NiJ1...
 * @apiParam           {String}  password
 * @apiParam           {String}  name
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK

 {
  "data": {
    "id": 1,
    "name": "Mahmoud Zalt 2",
    "email": "new@email.com",
    "token": null,
    "created_at": {
      "date": "2016-04-09 02:34:11.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-04-21 09:45:19.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
}
 */
$router->put('users/{id}', [
    'uses'       => 'Controller@updateUser',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            registerAgentUser
 * @api                {post} /register/agent Register a new User by his Agent Id (A.K.A Device ID). Use this endpoint, if the App doesn't require registration first. Where users can navigate through the App and register later. This Endpoint should be used whenever they decided to register.
 * @apiDescription     Create and Login new user (from agent)
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json
 * @apiHeader          Agent-Id 2BY1h82XPPRmtl53eJ7zFi7uiFwEJeWRWHZCIwd2
 * @apiParam           {String}  email
 * @apiParam           {String}  password
 * @apiParam           {String}  name
 * @apiSuccessExample  {json}    Success-Response:
* HTTP/1.1 200 OK
 *
* {
  * "data": {
    * "id": 1,
    * "name": "Mahmoud Zalt",
    * "email": "mahmoud@zalt.me",
    * "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsIm..."
    * "created_at": {
      * "date": "2016-04-09 02:34:11.000000",
      * "timezone_type": 3,
      * "timezone": "UTC"
    * },
    * "updated_at": {
      * "date": "2016-04-09 02:34:11.000000",
      * "timezone_type": 3,
      * "timezone": "UTC"
    * }
  * }
* }
 */
$router->post('register/agent', [
    'uses'  => 'Controller@registerAgentUser',
    'middleware' => [
        'agent.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            RegisterUser
 * @api                {post} /register Register a new User by his credentials
 * @apiDescription     Create and Login new user
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json
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
    'uses' => 'Controller@registerUser',
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            DeleteUser
 * @api                {delete} /users/{id} Delete a User
 * @apiDescription     Delete User from Database
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ91QiLCJhbGciOiJIUzI1NiJ1...
 */
$router->delete('users/{id}', [
    'uses'       => 'Controller@deleteUser',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            ListAllUsers
 * @api                {get} /users Search & List all Users
 * @apiDescription     List all the Application Users
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ91QiLCJhbGciOiJIUzI1NiJ1...
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
    'uses'       => 'Controller@listAllUsers',
    'middleware' => [
        'api.auth',
        'role:admin'
    ],
]);
