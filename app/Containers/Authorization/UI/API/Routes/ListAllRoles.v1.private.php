<?php

/**
 * @apiGroup           RolePermission
 * @apiName            listAllRoles
 * @api                {get} /v1/roles List all Roles
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

$router->get('roles', [
    'uses'       => 'Controller@listAllRoles',
    'middleware' => [
        'auth:api',
    ],
]);
