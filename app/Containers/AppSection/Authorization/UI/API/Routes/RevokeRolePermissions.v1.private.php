<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            RevokeRolePermissions
 *
 * @api                {delete} /v1/role/:role_id/permissions Revoke role permissions
 *
 * @apiDescription     Revoke role permissions
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
 * @apiBody            {String} permission_ids Array of permission id's
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\RevokeRolePermissionsController;
use Illuminate\Support\Facades\Route;

Route::delete('roles/{role_id}/permissions', RevokeRolePermissionsController::class)
    ->middleware(['auth:api']);
