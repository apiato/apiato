<?php

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            registerUser
 * @api                {post} /user/register Register User
 * @apiDescription     If the App supports Visitors Access (allows users to use)
 * the App first and register later) then you `must` send the `visitor-id` in the
 * header. If the app require registering first, with no access to Visitors, then
 * you can just pass the user info without the `visitor-id`.
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
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
 * @apiName            RefreshUser
 * @api                {post} /users/refresh Refresh User data
 * @apiDescription     Request the latest user Data. You can send the
 * `token` header or `user_id` parameter to get the updated user data.
 * (You can use this Endpoint whenever the user object is updated for any reason to get
 * his updated data).
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer {User-Token} (required)
 * @apiParam           user_id User Id (optional)
 * @apiUse             SingleUserSuccessResponse
 */
$router->post('users/refresh', [
    'uses' => 'Controller@refreshUser',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Users
 * @apiName            UpdateUser
 * @api                {put} /users Update User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer {User-Token} (required)
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


/**
 * @apiDefine SingleUserSuccessResponse
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 200 OK
{
  "data": {
    "id": 3,
    "name": "Mahmoud Zalt",
    "email": "mahmoud@zalt.me",
    "confirmed": null,
    "created_at": {
      "date": "2016-11-09 16:20:30.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-11-09 16:20:30.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImlzcyI6Imh0dHA6XC9cL2FwaS5wb21zLmRldlwvdXNlclwvcmVnaXN0ZXIiLCJpYXQiOjE0Nzg3MDg0MzAsImV4cCI6MTQ4MTMzNjQzMCwibmJmIjoxNDc4NzA4NDMwLCJqdGkiOiI2NmE2ZGM0N2RkNmRjMDBjZGY5ZGQyZWUwNTdhZGVhMCJ9.j_IZWRWzHQdoWl_YQUxEs0cPz9NEG48baebK1-8TRUY"
  }
}
 */

