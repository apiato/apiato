<?php

/**
 * @apiGroup           Users
 * @apiName            UpdateUser
 * @api                {put} /v1/users/:id Update User
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  password (optional)
 * @apiParam           {String}  name (optional)
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->put('users/{id}', [
    'uses'       => 'Controller@updateUser',
    'middleware' => [
        'auth:api',
    ],
]);
