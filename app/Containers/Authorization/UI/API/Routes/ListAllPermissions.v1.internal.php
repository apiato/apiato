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
   "data":[
      {
         "name":"create-applications",
         "description":"Create Application to gain third party access using special token",
         "display_name":""
      },
      {
         "name":"list-all-users",
         "description":"List all users in the system",
         "display_name":""
      },
      {
         "name":"delete-user",
         "description":"",
         "display_name":""
      }
      ...
   ]
}
 */

$router->get('permissions', [
    'uses'       => 'Controller@listAllPermissions',
    'middleware' => [
        'api.auth',
    ],
]);
