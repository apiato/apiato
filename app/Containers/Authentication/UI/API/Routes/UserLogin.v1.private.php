<?php

/**
 * @apiGroup           Authentication
 * @apiName            UserLogin
 *
 * @api                {post} /login Login a user
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}     email (required)
 * @apiParam           {String}     password (required)
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
 {
 "data": {
 "id": "owpmaymq",
 "name": "Super Admin",
 "email": "admin@admin.com",
 "confirmed": 0,
 "total_credits": 0,
 "created_at": {
 "date": "2017-01-23 18:40:46.000000",
 "timezone_type": 3,
 "timezone": "UTC"
 },
 "token": {
 "object": "token",
 "token": "eyJ0eXAxOiJKV1QcLCJhbGciO2JIUzI1NiJz..."
 "access_token": {
 "token_type": "Bearer",
 "time_to_live": {
 "minutes": 60
 },
 "expires_in": {
 "date": "2017-02-10 23:43:41.668135",
 "timezone_type": 3,
 "timezone": "UTC"
 }
 }
 },
 "updated_at": {
 "date": "2017-01-23 18:40:46.000000",
 "timezone_type": 3,
 "timezone": "UTC"
 },
 "deleted_at": null,
 "roles": {
 "data": [
 {
 "object": "Role",
 "name": "admin",
 "description": "Super Administrator",
 "display_name": null
 }
 ]
 }
 }
 }
 *
 * @apiErrorExample  {json}       Error-Response:
 {
 "message":"401 Credentials Incorrect.",
 "status_code":401
 }
 *
 * @apiErrorExample  {json}       Error-Response:
 */
Route::post('auth/login', [
    'uses' => 'Controller@userLogin',
]);
