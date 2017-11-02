<?php

/**
 * @apiGroup           User
 * @apiName            forgotPassword
 *
 * @api                {POST} /v1/password/forgot Forgot password
 * @apiDescription     Forgot password endpoint.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  reseturl the reset password url
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 202 OK
{}
 */

$router->post('password/forgot', [
    'as' => 'api_user_forgot_password',
    'uses'  => 'Controller@forgotPassword',
]);
