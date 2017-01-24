<?php

/**
 * @apiGroup           RolePermission
 * @apiName            listAllPermissions
 * @api                {get} /permissions List all Permission
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer {User-Token}
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
  "data": [
    {
      "object": "Permission",
      "name": "manage-roles-permissions",
      "description": "Manage Roles and Permissions for Users",
      "display_name": null
    },
    {
      "object": "Permission",
      "name": "delete-user",
      "description": null,
      "display_name": null
    },
    {
      "object": "Permission",
      "name": "update-user",
      "description": null,
      "display_name": null
    },
    {
      "object": "Permission",
      "name": "create-applications",
      "description": "Create Application to gain third party access using special token",
      "display_name": null
    }
  ]
}
 */

$router->get('permissions', [
    'uses'       => 'Controller@listAllPermissions',
    'middleware' => [
        'api.auth',
    ],
]);
