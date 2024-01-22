<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            GivePermissionsToUser
 *
 * @api                {patch} /v1/users/:id/permissions Attach Permissions To User
 *
 * @apiDescription     Attach direct permissions to user
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => 'manage-permissions', 'roles' => null]
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} id user's id
 *
 * @apiBody            {Array} permission_ids Array of Permissions ID's
 *
 * @apiUse            UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\GivePermissionsToUserController;
use Illuminate\Support\Facades\Route;

Route::patch('users/{id}/permissions', GivePermissionsToUserController::class)
    ->middleware(['auth:api']);
