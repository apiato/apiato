<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            GivePermissionsToRole
 *
 * @api                {post} /v1/roles/:role_id/permissions Attach permissions to role
 *
 * @apiDescription     Attach new permissions to a role.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} role_id
 *
 * @apiBody            {Array} permission_ids Array of permission id's
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\GivePermissionsToRoleController;
use Illuminate\Support\Facades\Route;

Route::post('roles/{role_id}/permissions', GivePermissionsToRoleController::class)
    ->middleware(['auth:api']);
