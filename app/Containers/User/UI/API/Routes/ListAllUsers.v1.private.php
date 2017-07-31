<?php

/**
 * @apiGroup           Users
 * @apiName            ListAllUsers
 * @api                {get} /v1/users List All Users
 * @apiDescription     List all Application Users (clients and admins). For all registered users "Clients" only you
 *                     can use `/clients`. And for all "Admins" only you can use `/admins`.
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
