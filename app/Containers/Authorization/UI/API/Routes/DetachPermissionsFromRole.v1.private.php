<?php

/**
 * @apiGroup           RolePermission
 * @apiName            detachPermissionFromRole
 * @api                {post} /permissions/detach Detach Permissions from Role
 * @apiDescription     Remove a permission from a Role. This doesn't not sync the Role it just remove
 *                     any permission you want to revoke from that role. To sync permissions you can
 *                     use `/permissions/sync` instead.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String} role_id Role ID
 * @apiParam           {String-Array} permissions_ids Permission ID or Array of Permissions ID's
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
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

$router->post('permissions/detach', [
    'uses'       => 'Controller@detachPermissionFromRole',
    'middleware' => [
        'api.auth',
    ],
]);
