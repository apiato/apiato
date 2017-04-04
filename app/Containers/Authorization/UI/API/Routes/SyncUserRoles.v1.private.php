<?php

/**
 * @apiGroup           RolePermission
 * @apiName            syncUserRoles
 * @api                {post} /roles/sync Sync User Roles
 * @apiDescription     You can use this endpoint instead of `roles/assign` & `roles/revoke`.
 *                     The sync endpoint will override all existing user roles with the new
 *                     one sent to this endpoint.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {Number} user_id User ID
 * @apiParam           {Array} roles_ids Role ID or Array of Roles ID's
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "data":{
      "id":abcderf,
      "name":"Mrs. Genoveva Prosacco",
      "email":"abbigail.rolfson@hotmail.com",
      "confirmed":"0",
      "total_credits":0,
      "created_at":{
         "date":"2016-12-30 20:18:33.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "token":null,
      "updated_at":{
         "date":"2016-12-30 20:18:33.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "deleted_at":null,
      "roles":{
         "data":[
            {
               "object": "Role",
               "id": abcderf,
               "name":"admin",
               "description":"Super Administrator",
               "display_name":""
            },
            {
               "object": "Role",
               "id": ascderf,
               "name":"client",
               "description":"Normal Client",
               "display_name":""
            }
         ]
      }
   }
}
 */

$router->post('roles/sync', [
    'uses'       => 'Controller@syncUserRoles',
    'middleware' => [
        'auth:api',
    ],
]);
