<?php

/**
 * @apiGroup           RolePermission
 * @apiName            attachPermissionToRole
 * @api                {post} /permissions/attach Attach Permission to Role
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer {User-Token}
 *
 * @apiParam           {String} role_name Name of the Role
 * @apiParam           {Array} permission_name Names of Permissions (accepts String or Array)
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "name":"role-A",
      "description":"AA",
      "display_name":"A"
   }
}
 */

$router->post('permissions/attach', [
    'uses'       => 'Controller@attachPermissionToRole',
    'middleware' => [
        'api.auth',
    ],
]);
