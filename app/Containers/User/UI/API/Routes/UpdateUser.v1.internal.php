<?php

/**
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
