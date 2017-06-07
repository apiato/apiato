<?php

/**
 * @apiGroup           RolePermission
 * @apiName            listAllPermissions
 * @api                {get} /v1/permissions List all Permission
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

$router->get('permissions', [
    'uses'       => 'Controller@listAllPermissions',
    'middleware' => [
        'auth:api',
    ],
]);
