<?php

/**
 * @apiGroup           Users
 * @apiName            getAuthenticatedUser
 *
 * @api                {GET} /v1/user/profile Find Logged in User data (Profile Information)
 * @apiDescription     Find the user details of the logged in user from its Token. (without specifying his ID)
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->get('user/profile', [
    'as' => 'api_user_get_authenticated_user',
    'uses'  => 'Controller@getAuthenticatedUser',
    'middleware' => [
      'auth:api',
    ],
]);
