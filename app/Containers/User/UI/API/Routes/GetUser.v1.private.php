<?php

/**
 * @apiGroup           Users
 * @apiName            getUser
 * @api                {get} /v1/users/:id Get User
 * @apiDescription     Find a user by its ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->get('users/{id}', [
    'uses'       => 'Controller@getUser',
    'middleware' => [
        'auth:api',
    ],
]);
