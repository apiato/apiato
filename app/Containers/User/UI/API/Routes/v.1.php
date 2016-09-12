<?php

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            RefreshUser
 * @api                {post} /users/refresh Refresh User data
 * @apiDescription     Request the latest user Data. You can send the `visitor-id`
 * header, `token` header or `user_id` parameter to get the updated user data.
 * (You can use this Endpoint whenever the user object is updated for any reason to get
 * his updated data).
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiHeader          visitor-id The Device ID [12345] (optional)
 * @apiHeader          Authorization The user token [Bearer a1b2c3d4..] (optional)
 * @apiParam           user_id User Id (optional)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 200 OK

{
  "data": {
    "id": 1,
    "name": "Mahmoud Zalt",
    "email": "mahmoud@zalt.me",
    "confirmed": 0,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2FwaS5yZXdhcmRmb3guZGV2XC9yZWdpc3RlclwvdmlzaXRvciIsImlhdCI6MTQ3MDc2MTk0NCwiZXhwIjoxNDczMzg5OTQ0LCJuYmYiOjE0NzA3NjE5NDQsImp0aSI6ImVkNjNjYmQ0YjUxMGQ0YWMwZjQ3ZWVlODMyMGM1MTM4In0.WoenjRSsW11QqFiCpUOx7y40HG44QD-qBMjsP3hwAWs",
    "created_at": {
      "date": "2016-08-09 16:57:44.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-08-09 16:59:04.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
}
 */
$router->post('users/refresh', [
    'uses' => 'Controller@refreshUser',
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            UpdateUser
 * @api                {put} /users Update User
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
$router->put('users', [
    'uses'       => 'Controller@updateUser',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            registerVisitorUser
 * @api                {post} /register/visitor Register Visitor
 * @apiDescription     This is different than the Register User (Create User) Endpoint.
 * This will register and login a User by his Visitor Id (A.K.A Device ID), and it
 * require that the user is already created as Visitor before.
 * This registration Endpoint must be used when the App allows Users to use the App
 * first and register later.
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiHeader          visitor-id The Device ID [12345] (required)
 * @apiParam           {String}  email (required)
 * @apiParam           {String}  password (required)
 * @apiParam           {String}  name (optional)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 200 OK
 {
  "data": {
    "id": 4,
    "name": "Mahmoud Zalt",
    "email": "mahmoud@zalt.me",
    "confirmed": 0,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImlzcyI6Imh0dHA6XC9cL2FwaS5yZXdhcmRmb3guZGV2XC9yZWdpc3RlclwvdmlzaXRvciIsImlhdCI6MTQ2OTIxMjYzOSwiZXhwIjoxNDcxODQwNjM5LCJuYmYiOjE0NjkyMTI2MzksImp0aSI6ImMwYWZjNTA0NmRlOTg4NmZmYjM1NTk0ZjdlYTE3MTczIn0.zapUpSsIwb-jR9wZyj2oQFMGPZwouSMJhMxAjjDd2q8",
    "created_at": {
      "date": "2016-07-22 18:37:19.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-07-22 18:37:19.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
}
 */
$router->post('register/visitor', [
    'uses'  => 'Controller@registerVisitorUser',
    'middleware' => [
        'api.auth.visitor',
    ],
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            RegisterUser
 * @api                {post} /register Create User (Register)
 * @apiDescription     Register a new User by credentials. This will also Login the
 * new created user.
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
    "confirmed": 0,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImlzcyI6Imh0dHA6XC9cL2FwaS5yZXdhcmRmb3guZGV2XC9yZWdpc3RlclwvdmlzaXRvciIsImlhdCI6MTQ2OTIxMjYzOSwiZXhwIjoxNDcxODQwNjM5LCJuYmYiOjE0NjkyMTI2MzksImp0aSI6ImMwYWZjNTA0NmRlOTg4NmZmYjM1NTk0ZjdlYTE3MTczIn0.zapUpSsIwb-jR9wZyj2oQFMGPZwouSMJhMxAjjDd2q8",
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
 * @api                {delete} /users/{id} Delete User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParam           {Number}  id the user id in the uri (required)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 202 OK
{
  "message": "User (4) Deleted Successfully."
}
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
 * @apiDescription     List all the Application Users. You can search for Users
 * by email, name and ID
 * Example: `?search=Mahmoud` or `?search=whatever@mail.com`.
 * You can specify the field as follow `?search=email:whatever@mail.com` or `?search=id:20`.
 * You can search by multiple fields as follow: `?search=name:Mahmoud&email:whatever@mail.com`.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParam           search           ?search=name:John Doe;email:john@main.com (optional)
 * @apiParam           searchFields     ?searchFields=name:like;email:= (optional)
 * @apiParam           paginate         ?page=3 (optional)
 * @apiParam           order            ?orderBy=id (optional)
 * @apiParam           sort             ?sortedBy=asc (optional)
 * @apiParam           filter           ?filter=id;name;age (optional)
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK

 {
  "data": [
    {
      "id": 2,
      "name": "Mahmoud Zalt",
      "email": "mahmoud@zalt.me",
      "confirmed": 0,
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
      "confirmed": 0,
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
