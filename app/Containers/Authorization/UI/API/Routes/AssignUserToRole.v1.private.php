<?php

/**
 * @apiGroup           RolePermission
 * @apiName            assignUserToRole
 * @api                {post} /v1/roles/assign Assign User to Roles
 * @apiDescription     Assign new roles to user. This endpoint does not sync the user with the
 *                     new roles. It simply assign new role to the user. So make sure
 *                     to never send an already assigned role since it will cause an error.
 *                     To sync (update) all existing roles with the new ones use
 *                     `/roles/sync` endpoint instead.
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

$router->post('roles/assign', [
    'uses'       => 'Controller@assignUserToRole',
    'middleware' => [
        'auth:api',
    ],
]);
