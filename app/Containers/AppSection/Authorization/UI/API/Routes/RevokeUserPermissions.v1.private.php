<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            RevokeUserPermissions
 *
 * @api                {delete} /v1/users/:user_id/permissions Detach Permission From User
 *
 * @apiDescription     Detach direct permissions assigned to user.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-permissions', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} user_id
 *
 * @apiBody            {String} permission_ids Array of Permissions ID's
 *
 * @apiUse            UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\RevokeUserPermissionsController;
use Illuminate\Support\Facades\Route;

Route::delete('users/{user_id}/permissions', RevokeUserPermissionsController::class)
    ->middleware(['auth:api']);
