<?php

/**
 * @apiGroup           Users
 * @apiName            ListAllUsers
 * @api                {get} /v1/users List All Users
 * @apiDescription     List all Application Users of any roles. For listing all registered users "Clients" only you
 *                     can use `/clients`. And for listing all Admins (users of role Admin) only you can use `/admins`.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

$router->get('users', [
    'uses'       => 'Controller@listAllUsers',
    'middleware' => [
        'auth:api',
    ],
]);
