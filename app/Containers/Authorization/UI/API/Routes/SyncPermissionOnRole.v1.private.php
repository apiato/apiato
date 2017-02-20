<?php

/**
 * @apiGroup           RolePermission
 * @apiName            syncPermissionOnRole
 * @api                {post} /permissions/sync Sync Permissions on Role
 * @apiDescription     You can use this endpoint instead of `permissions/attach` & `permissions/detach`.
 *                     The sync endpoint will override all existing role permissions with the new
 *                     one sent to this endpoint.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String} role_id Role ID
 * @apiParam           {String-Array} permissions_ids Permission ID or Array of Permissions ID's
 *
 * @apiSuccessExample  {json}       Success-Response:
{
  "data": {
    "object": "Role",
    "name": "player",
    "description": null,
    "display_name": null,
    "permissions": {
      "data": [
        {
          "object": "Permission",
          "id": abcderf,
          "name": "play football",
          "description": null,
          "display_name": null
        },
        {
          "object": "Permission",
          "id": abcderf,
          "name": "access secret info",
          "description": null,
          "display_name": null
        }
      ]
    }
  }
}
 */

$router->post('permissions/sync', [
    'uses'       => 'Controller@syncPermissionOnRole',
    'middleware' => [
        'api.auth',
    ],
]);
