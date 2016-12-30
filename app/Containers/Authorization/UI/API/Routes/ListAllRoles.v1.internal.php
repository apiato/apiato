<?php

/**
 * @apiGroup           RolePermission
 * @apiName            listAllRoles
 * @api                {get} /roles List all Roles
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
         "name":"developer",
         "description":"A developer account, has access to the API",
         "display_name":""
      },
      {
         "name":"admin",
         "description":"Super Administrator",
         "display_name":""
      },
      {
         "name":"client",
         "description":"Normal Client",
         "display_name":""
      }
   ]
}
 */

$router->get('roles', [
    'uses'       => 'Controller@listAllRoles',
    'middleware' => [
        'api.auth',
    ],
]);
