<?php

/*********************************************************************************
 * @apiGroup           Authentication
 * @apiName            UserLogin
 * @api                {post} /user/login Login a user
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiParam           {String}     email (required)
 * @apiParam           {String}     password (required)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 200 OK

{
  "data": {
    "id": 4,
    "name": "Mahmoud Zalt",
    "email": "mahmoud@zalt.me",
    "confirmed": 0,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2FwaS5yZXdhcmRmb3guZGV2XC9sb2dpbiIsImlhdCI6MTQ2OTIxMjk4NCwiZXhwIjoxNDcxODQwOTg0LCJuYmYiOjE0NjkyMTI5ODQsImp0aSI6IjE2MzkzM2Y2ZDU4OGI3ZWM4MjY5YTM1ZTlmNjBkMTdjIn0.7DqcTv0tKf6dcs4cc8iH5VvAoz9P1p9b-cqXsk9lPoY",
    "created_at": {
      "date": "2016-07-22 18:42:42.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-07-22 18:42:54.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
}
 */
$router->post('user/login', [
    'uses' => 'Controller@userLogin',
]);

/*********************************************************************************
 * @apiGroup           Authentication
 * @apiName            UserLogout
 * @api                {post} /user/logout Logout a user
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 202 Accepted

{
  "message": "User Logged Out Successfully."
}
 */
$router->post('user/logout', [
    'uses'       => 'Controller@userLogout',
    'middleware' => [
        'api.auth',
    ],
]);

