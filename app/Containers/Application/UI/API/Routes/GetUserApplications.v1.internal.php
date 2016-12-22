<?php

/*********************************************************************************
 * @apiGroup           Applications
 * @apiName            getUserApplications
 * @api                {post} /apps Get All user Apps
 * @apiDescription     Get all your user Apps and their Tokens
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User (with Developer role)
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 */
$router->get('apps', [
    'uses'       => 'Controller@getUserApplications',
    'middleware' => [
        'api.auth',
        'role:developer',
    ],
]);
