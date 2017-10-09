<?php

/**
 * @apiGroup           RolePermission
 * @apiName            listAllRoles
 * @api                {get} /v1/roles Get All Roles
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

$router->get('roles', [
    'as' => 'API_Authorization_listAllRoles',
    'uses'       => 'Controller@listAllRoles',
    'middleware' => [
        'auth:api',
    ],
]);
