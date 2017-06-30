<?php

/**
 * @apiGroup           User
 * @apiName            getMyProfile
 *
 * @api                {GET} /v1/my/profile Get own User
 * @apiDescription     Get the own profile (some sort of alias for GET /users/xyz - however, you don't need to specify the ID)
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

$router->get('my/profile', [
    'uses'  => 'Controller@getMyProfile',
    'middleware' => [
      'auth:api',
    ],
]);
