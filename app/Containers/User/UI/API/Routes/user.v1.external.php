<?php

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







/*****************************************************************
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
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiO...
  }
}
 */
