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
 * @apiUse             SingleUserSuccessResponse
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
 * @apiUse             SingleUserSuccessResponse
 */
$router->put('users', [
    'uses'       => 'Controller@updateUser',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            registerVisitor
 * @api                {post} /visitor/register Register visitor (even if he exist)
 * @apiDescription     This endpoint must be called on App startup. (when the App
 * allows using it before registering). The endpoint will create a user record
 * if not already exist based on his unique visitor-id (A.K.A device ID) and return
 * the `User ID`. Later when the user is required to register, we simply
 * update his existing record with his information (email, password,...).
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiHeader          visitor-id The Device ID [12345] (required)
 * @apiUse             SingleUserSuccessResponse
 */
$router->post('visitor/register', [
    'uses'  => 'Controller@registerVisitor',
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            registerUser
 * @api                {post} /user/register Register User
 * @apiDescription     If the App supports Visitors Access (allows users to use)
 * the App first and register later) then you `must` send the `visitor-id` in the
 * header. If the app require registering first, with no access to Visitors, then
 * you can just pass the user info without the `visitor-id`.
 * @apiVersion         1.0.0
 * @apiPermission      none/Visitor
 * @apiHeader          Accept application/json (required)
 * @apiHeader          visitor-id The Device ID [12345] (depend)
 * @apiParam           {String}  email (required)
 * @apiParam           {String}  password (required)
 * @apiParam           {String}  name (optional)
 * @apiParam           {String}  gender (optional)
 * @apiParam           {String}  birth (optional)
 * @apiUse             SingleUserSuccessResponse
 */
$router->post('user/register', [
    'uses'  => 'Controller@registerUser',
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            DeleteUser
 * @api                {delete} /users Delete User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 202 OK
{
  "message": "User (4) Deleted Successfully."
}
 */
$router->delete('users', [
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
