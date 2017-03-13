<?php

/**
 * @apiGroup           RolePermission
 * @apiName            getPermission
 * @api                {get} /permissions/:id Find a Permission by ID
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
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

Route::get('permissions/{id}', [
    'uses'       => 'Controller@getPermission',
    'middleware' => [
        'auth:api',
    ],
]);
