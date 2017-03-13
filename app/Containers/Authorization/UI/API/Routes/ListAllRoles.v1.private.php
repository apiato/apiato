<?php

/**
 * @apiGroup           RolePermission
 * @apiName            listAllRoles
 * @api                {get} /roles List all Roles
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
  "data": [
    {
      "object": "Role",
      "id": "sdadsdasd",
      "name": "admin",
      "description": "Super Administrator",
      "display_name": null,
      "permissions": {
        "data": [
          {
            "object": "Permission",
            "name": "update-user",
            "description": null,
            "display_name": null
          },
          {
            "object": "Permission",
            "name": "delete-item",
            "description": null,
            "display_name": null
          }
        ]
      }
    },
    {
      "object": "Role",
      "id": "adfghew",
      "name": "client",
      "description": "Normal Client",
      "display_name": null,
      "permissions": {
        "data": [
          {
            "object": "Permission",
            "name": "update-user",
            "description": null,
            "display_name": null
          }
        ]
      }
    },
    {
      "object": "Role",
      "id": "sdfafs",
      "name": "developer",
      "description": "A developer account, has access to the API",
      "display_name": null,
      "permissions": {
        "data": [
          {
            "object": "Permission",
            "name": "create-applications",
            "description": "Create Application to gain third party access using special token",
            "display_name": null
          }
        ]
      }
    },
    {
      "object": "Role",
      "name": "player",
      "description": null,
      "display_name": null,
      "permissions": {
        "data": [
          {
            "object": "Permission",
            "name": "access secret info",
            "description": null,
            "display_name": null
          }
        ]
      }
    }
  ]
}
 */

Route::get('roles', [
    'uses'       => 'Controller@listAllRoles',
    'middleware' => [
        'auth:api',
    ],
]);
