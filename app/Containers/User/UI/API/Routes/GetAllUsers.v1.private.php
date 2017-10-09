<?php

/**
 * @apiGroup           Users
 * @apiName            listAllUsers
 * @api                {get} /v1/users Get All Users
 * @apiDescription     Get All Application Users (clients and admins). For all registered users "Clients" only you
 *                     can use `/clients`. And for all "Admins" only you can use `/admins`.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

$router->get('users', [
    'as' => 'API_User_listAllUsers',
    'uses'       => 'Controller@listAllUsers',
    'middleware' => [
        'auth:api',
    ],
]);
