<?php

/**
 * @apiGroup           RolePermission
 * @apiName            getPermission
 * @api                {get} /find-permission Get a Permission by unique name
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer {User-Token}
 *
 * @apiParam           {String} name required
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "object": "Permission",
      "id": abcderf,
      "name":"anything",
      "description":"",
      "display_name":"bla bla bla"
   }
}
 */

$router->get('find-permission', [
    'uses'       => 'Controller@getPermission',
    'middleware' => [
        'api.auth',
    ],
]);
