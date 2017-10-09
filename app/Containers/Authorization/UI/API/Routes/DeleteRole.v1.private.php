<?php

/**
 * @apiGroup           RolePermission
 * @apiName            deleteRole
 * @api                {delete} /v1/roles/:id Delete a Role
 * @apiDescription     Delete Role by ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Role
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
{
    "message": "Role (manager) Deleted Successfully."
}
 */

$router->delete('roles/{id}', [
    'as' => 'api_authorization_delete_role',
    'uses'       => 'Controller@deleteRole',
    'middleware' => [
        'auth:api',
    ],
]);
