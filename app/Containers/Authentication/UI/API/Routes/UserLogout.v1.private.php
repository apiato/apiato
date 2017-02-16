<?php

/**
 * @apiGroup           Authentication
 * @apiName            UserLogout
 * @api                {post} /user/logout Logout a user
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 Accepted
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

