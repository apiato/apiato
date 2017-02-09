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
      "name":"",
      "description":"Create, View, Modify, Assign, Attach.. Roles and Permissions for Users",
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
