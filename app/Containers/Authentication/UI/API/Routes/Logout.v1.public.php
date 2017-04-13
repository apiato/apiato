<?php
/**
 * @apiGroup           OAuth2
 * @apiName            Logout
 * @api                {post} /v1/logout
 * @apiDescription     User Logout. (Revoking Access Token)
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 */
$router->post('logout', [
    'uses'  => 'Controller@logout',
    'middleware' => [
        'auth:api',
    ],
]);

