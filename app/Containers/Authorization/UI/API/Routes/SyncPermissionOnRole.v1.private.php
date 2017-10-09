<?php

/**
 * @apiGroup           RolePermission
 * @apiName            syncPermissionOnRole
 * @api                {post} /v1/permissions/sync Sync Permissions on Role
 * @apiDescription     You can use this endpoint instead of `permissions/attach` & `permissions/detach`.
 *                     The sync endpoint will override all existing role permissions with the new
 *                     one sent to this endpoint.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String} role_id Role ID
 * @apiParam           {Array} permissions_ids Permission ID or Array of Permissions ID's
 *
 * @apiUse             RoleSuccessSingleResponse
 */

$router->post('permissions/sync', [
    'as' => 'api_authorization_sync_permission_on_role',
    'uses'       => 'Controller@syncPermissionOnRole',
    'middleware' => [
        'auth:api',
    ],
]);
