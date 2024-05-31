<?php

/**
 * @apiGroup           RolePermission
 *
 * @apiName            GivePermissionsToUser
 *
 * @api                {post} /v1/users/:user_id/permissions Attach permissions to user
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
 * @apiParam           {String} user_id
 *
 * @apiBody            {Array} permission_ids Array of permission id's
 *
 * @apiUse            UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\GivePermissionsToUserController;
use Illuminate\Support\Facades\Route;

Route::post('users/{user_id}/permissions', GivePermissionsToUserController::class)
    ->middleware(['auth:api']);
