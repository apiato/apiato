<?php

/**
 * @apiGroup           RolePermission
 * @apiName            createPermission
 * @api                {post} /permissions Create new Permission
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer {User-Token}
 *
 * @apiParam           {String} name Unique Permission Name
 * @apiParam           {String} [description]
 * @apiParam           {String} [display_name]
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "object":"Permission",
      "name":"eat-people",
      "description":"can eat people",
      "display_name":"zombie"
   }
}
 */

$router->post('permissions', [
    'uses'       => 'Controller@createPermission',
    'middleware' => [
        'api.auth',
    ],
]);
