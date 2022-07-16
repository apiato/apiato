<?php

/**
 * @apiGroup           UserPermission
 * @apiName            DetachPermissionFromUser
 *
 * @api                {POST} /v1/users/permissions/detach Detach Permission From User
 * @apiDescription     Detach direct permissions assigned to user.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-permissions', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody           {String} user_id
 * @apiBody           {String-Array} permissions_ids Permission ID or Array of Permissions ID's
 *
 * @apiUse            UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\DetachPermissionsFromUserController;
use Illuminate\Support\Facades\Route;

Route::post('users/permissions/detach', [DetachPermissionsFromUserController::class, 'detachPermissionFromUser'])
    ->middleware(['auth:api']);

