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
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {Number} user_id User ID
 * @apiParam           {Array} roles_ids Role ID or Array of Roles ID's
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->post('roles/assign', [
    'as' => 'api_authorization_assign_user_to_role',
    'uses'       => 'Controller@assignUserToRole',
    'middleware' => [
        'auth:api',
    ],
]);
