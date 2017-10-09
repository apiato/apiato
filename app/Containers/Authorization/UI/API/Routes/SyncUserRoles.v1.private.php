<?php

/**
 * @apiGroup           RolePermission
 * @apiName            syncUserRoles
 * @api                {post} /v1/roles/sync Sync User Roles
 * @apiDescription     You can use this endpoint instead of `roles/assign` & `roles/revoke`.
 *                     The sync endpoint will override all existing user roles with the new
 *                     one sent to this endpoint.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {Number} user_id User ID
 * @apiParam           {Array} roles_ids Role ID or Array of Roles ID's
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->post('roles/sync', [
    'as' => 'api_authorization_sync_user_roles',
    'uses'       => 'Controller@syncUserRoles',
    'middleware' => [
        'auth:api',
    ],
]);
