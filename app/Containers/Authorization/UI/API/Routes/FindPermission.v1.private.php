<?php

/**
 * @apiGroup           RolePermission
 * @apiName            getPermission
 * @api                {get} /v1/permissions/:id Find a Permission by ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             PermissionSuccessSingleResponse
 */

$router->get('permissions/{id}', [
    'as' => 'API_Authorization_getPermission',
    'uses'       => 'Controller@findPermission',
    'middleware' => [
        'auth:api',
    ],
]);
