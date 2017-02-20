<?php

/**
 * @apiGroup           RolePermission
 * @apiName            syncPermissionOnRole
 * @api                {post} /permissions/sync Sync Permissions on Role
 * @apiDescription     You can use this endpoint instead of `permissions/attach` & `permissions/detach`.
 *                     When sending permissions to a role using the `sync` endpoint, the role will only
 *                     have the sent permissions, as this will override all existing permissions with
 *                     the new sent permissions.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String} role_id Role ID
 * @apiParam           {String-Array} permissions_ids Permission ID or Array of Permissions ID's
 *
 * @apiSuccessExample  {json}       Success-Response:
* {
  * "data": {
    * "object": "Role",
    * "name": "player",
    * "description": null,
    * "display_name": null,
    * "permissions": {
      * "data": [
        * {
          * "object": "Permission",
          * "id": abcderf,
          * "name": "play football",
          * "description": null,
          * "display_name": null
        * },
        * {
          * "object": "Permission",
          * "id": abcderf,
          * "name": "access secret info",
          * "description": null,
          * "display_name": null
        * }
      * ]
    * }
  * }
* }
 */

$router->post('permissions/sync', [
    'uses'       => 'Controller@syncPermissionOnRole',
    'middleware' => [
        'api.auth',
    ],
]);
