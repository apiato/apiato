<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            RevokeRolePermissions
 *
 * @api                {post} /v1/permissions/detach Detach Permissions from Role
 *
 * @apiDescription     Detach existing permission from role. This endpoint does not sync the role
 *                     It just detaches the passed permissions from the role. So make sure
 *                     to never send a non-attached permission since it will cause an error.
 *                     To sync (update) all existing permissions with the new ones use
 *                     `/permissions/sync` endpoint instead.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-roles', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody           {String} role_id Role ID
 * @apiBody           {String} permission_ids Array of Permissions ID's
 *
 * @apiUse             RoleSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\RevokeRolePermissionsController;
use Illuminate\Support\Facades\Route;

Route::post('permissions/detach', RevokeRolePermissionsController::class)
    ->middleware(['auth:api']);
