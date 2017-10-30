<?php

/**
 * @apiGroup           User
 * @apiName            resetPassword
 *
 * @api                {POST} /v1/password-reset Reset Password
 * @apiDescription     Resets a password for an user.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email (required|email|max:255)
 * @apiParam           {String}  token (required|max:255) from the forgot password email
 * @apiParam           {String}  password (required|min:6|max:255) the new password
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 OK
{}
 */

/** @var Route $router */
$router->post('password-reset', [
    'as' => 'api_user_reset_password',
    'uses'  => 'Controller@resetPassword',
    'middleware' => [
    ],
]);
