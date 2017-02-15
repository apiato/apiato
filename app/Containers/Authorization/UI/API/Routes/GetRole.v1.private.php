<?php

/**
 * @apiGroup           RolePermission
 * @apiName            getRole
 * @api                {get} /find-role Get a Role by unique name
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
      "object": "Role",
      "id":"sdffsf",
      "name":"admin",
      "description":"Super Administrator",
      "display_name":""
   }
}
 */

$router->get('find-role', [
    'uses'       => 'Controller@getRole',
    'middleware' => [
        'api.auth',
    ],
]);
