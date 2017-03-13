<?php

/**
 * @apiGroup           RolePermission
 * @apiName            detachPermissionFromRole
 * @api                {post} /permissions/detach Detach Permissions from Role
 * @apiDescription     Detach existing permission from role. This endpoint does not sync the role
 *                     It just detach the passed permissions from the role. So make sure
 *                     to never send an non attached permission since it will cause an error.
 *                     To sync (update) all existing permissions with the new ones use
 *                     `/permissions/sync` endpoint instead.
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

Route::post('permissions/detach', [
    'uses'       => 'Controller@detachPermissionFromRole',
    'middleware' => [
        'auth:api',
    ],
]);
