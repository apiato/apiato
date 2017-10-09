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
    'as' => 'api_authorization_get_permission',
    'uses'       => 'Controller@findPermission',
    'middleware' => [
        'auth:api',
    ],
]);
