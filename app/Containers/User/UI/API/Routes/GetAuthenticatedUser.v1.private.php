<?php

/**
 * @apiGroup           Users
 * @apiName            GetAuthenticatedUser
 * @api                {get} /v1/userinfo Get Authenticated User without specifying it's ID
 * @apiDescription     Get the current authenticated user object.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->get('userinfo', [
    'uses'       => 'Controller@getAuthenticatedUserData',
    'middleware' => [
        'auth:api',
    ],
]);
