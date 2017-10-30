<?php

/**
 * @apiGroup           User
 * @apiName            forgotPassword
 *
 * @api                {POST} /v1/password-forgot Forgot password
 * @apiDescription     Forgot password endpoint.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email (required|email|max:255)
 * @apiParam           {String}  reseturl (required|max:255)
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 202 OK
{}
 */

/** @var Route $router */
$router->post('password-forgot', [
    'as' => 'api_user_forgot_password',
    'uses'  => 'Controller@forgotPassword',
    'middleware' => [
    ],
]);
