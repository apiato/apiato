<?php

/**
 * @apiGroup           RolePermission
 * @apiName            revokeRoleFromUser
 * @api                {post} /roles/revoke Revoke/Remove Roles from User
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {Number} user_id user ID
 * @apiParam           {Array-String} roles_ids Role ID or Array of Role ID's
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
               "object":"Role",
               "id":"insa",
               "name":"admin",
               "description":"Super Administrator",
               "display_name":""
            },
            {
               "object":"Role",
               "id":"insa",
               "name":"client",
               "description":"Normal Client",
               "display_name":""
            }
         ]
      }
   }
}
 */

$router->post('roles/revoke', [
    'uses'       => 'Controller@revokeRoleFromUser',
    'middleware' => [
        'api.auth',
    ],
]);
