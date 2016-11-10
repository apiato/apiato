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
 * @apiName            DeleteUser
 * @api                {delete} /users Delete User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer {User-Token} (required)
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
        'role:admin',
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
 * @apiHeader          Authorization Bearer {User-Token} (required)
 * @apiParam           search           ?search=name:John Doe;email:john@main.com (optional)
 * @apiParam           searchFields     ?searchFields=name:like;email:= (optional)
 * @apiParam           paginate         ?page=3 (optional)
 * @apiParam           order            ?orderBy=id (optional)
 * @apiParam           sort             ?sortedBy=asc (optional)
 * @apiParam           filter           ?filter=id;name;age (optional)
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK
{

}
 */
$router->get('users', [
    'uses'       => 'Controller@listAllUsers',
    'middleware' => [
        'api.auth',
        'role:admin'
    ],
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
