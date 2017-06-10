<?php

/**
 * @apiGroup           Users
 * @apiName            CreateAdmin
 * @api                {post} /v1/admins Create Admin type Users
 * @apiDescription     Creating non client Users, form the Dashboard.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  password
 * @apiParam           {String}  name
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->post('admins', [
    'uses'  => 'Controller@createAdmin',
    'middleware' => [
        'auth:api',
    ],
]);
