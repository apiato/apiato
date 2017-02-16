<?php

/**
 * @apiGroup           RolePermission
 * @apiName            createRole
 * @api                {post} /roles Create new Role
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer {User-Token}
 *
 * @apiParam           {String} name Unique Role Name
 * @apiParam           {String} [description]
 * @apiParam           {String} [display_name]
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "object":"Role",
      "id": abcderf,
      "name":"Manager",
      "description":"he manages things",
      "display_name":"something else"
   }
}
 */

$router->post('roles', [
    'uses'       => 'Controller@createRole',
    'middleware' => [
        'api.auth',
    ],
]);
