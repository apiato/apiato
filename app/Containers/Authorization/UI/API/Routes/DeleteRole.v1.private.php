<?php

/**
 * @apiGroup           RolePermission
 * @apiName            deleteRole
 * @api                {delete} /roles/:id Delete Role or Admin
 * @apiDescription     Delete Roles of any type (Admin, Client,...)
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Role
 *
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer {Role-Token}
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
{
    "message": "Role (14) Deleted Successfully."
}
 */

$router->delete('roles/{id}', [
    'uses'       => 'Controller@deleteRole',
    'middleware' => [
        'api.auth',
    ],
]);
