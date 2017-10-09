<?php

/**
 * @apiGroup           Users
 * @apiName            getUserProfile
 *
 * @api                {GET} /v1/user/profile Find Logged in User data
 * @apiDescription     Find the user details of the logged in user from its Token. (without specifying his ID)
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->get('user/profile', [
    'as' => 'API_User_getUserProfile',
    'uses'  => 'Controller@findUserProfile',
    'middleware' => [
      'auth:api',
    ],
]);
