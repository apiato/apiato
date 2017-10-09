<?php

/**
 * @apiGroup           RolePermission
 * @apiName            listAllPermissions
 * @api                {get} /v1/permissions Get All Permission
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

$router->get('permissions', [
    'as' => 'API_Authorization_listAllPermissions',
    'uses'       => 'Controller@listAllPermissions',
    'middleware' => [
        'auth:api',
    ],
]);
