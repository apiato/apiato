<?php

/**
 * @apiGroup           Users
 * @apiName            getUser
 * @api                {get} /v1/users/:id Find User
 * @apiDescription     Find a user by its ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->get('users/{id}', [
    'as' => 'api_user_get_user',
    'uses'       => 'Controller@findUser',
    'middleware' => [
        'auth:api',
    ],
]);
