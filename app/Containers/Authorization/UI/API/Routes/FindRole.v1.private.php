<?php

/**
 * @apiGroup           RolePermission
 * @apiName            getRole
 * @api                {get} /roles/:id Find a Role by ID
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "object": "Role",
      "id":"sdffsf",
      "name":"admin",
      "description":"Super Administrator",
      "display_name":""
   }
}
 */

$router->get('roles/{id}', [
    'uses'       => 'Controller@getRole',
    'middleware' => [
        'auth:api',
    ],
]);
