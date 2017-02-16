<?php

/**
 * @apiGroup           RolePermission
 * @apiName            attachPermissionToRole
 * @api                {post} /permissions/attach Attach Permissions to Role
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer {User-Token}
 *
 * @apiParam           {String} role_id ID of the Role
 * @apiParam           {String-Array} permissions_ids ID's of the Permissions
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

$router->post('permissions/attach', [
    'uses'       => 'Controller@attachPermissionToRole',
    'middleware' => [
        'api.auth',
    ],
]);
