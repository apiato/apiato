<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            DetachPermissionFromUser
 *
 * @api                {delete} /v1/users/:id/permissions Detach Permission From User
 *
 * @apiDescription     Detach direct permissions assigned to user.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-permissions', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id user's id
 *
 * @apiBody            {String} permissions_ids Array of Permissions ID's
 *
 * @apiUse            UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\DetachPermissionsFromUserController;
use Illuminate\Support\Facades\Route;

Route::delete('users/{id}/permissions', DetachPermissionsFromUserController::class)
    ->middleware(['auth:api']);
