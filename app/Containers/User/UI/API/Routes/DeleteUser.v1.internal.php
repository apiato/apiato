<?php

/**
 * @apiGroup           Users
 * @apiName            DeleteUser
 * @api                {delete} /users Delete User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
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
