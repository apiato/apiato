<?php

/**
 * @apiGroup           Users
 * @apiName            getUserProfile
 *
 * @api                {GET} /v1/user/profile Get Logged in User data
 * @apiDescription     Get the user details of the logged in user from its Token. (without specifying his ID)
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->get('user/profile', [
    'uses'  => 'Controller@getUserProfile',
    'middleware' => [
      'auth:api',
    ],
]);
