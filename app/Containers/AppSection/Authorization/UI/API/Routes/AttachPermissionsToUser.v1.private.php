<?php

/**
 * @apiGroup           UserPermission
 * @apiName            AssignPermissionsToUser
 *
 * @api                {GET} /v1/users/:id/permissions/attach Attach Permissions To User
 * @apiDescription     Attach direct permissions to user
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => 'manage-permissions', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiBody           {String} id user's id
 * @apiBody           {Array} permission_ids Permission ID or Array of Permissions ID's
 *
 * @apiUse            UserSuccessSingleResponse
 */

use App\Containers\AppSection\Authorization\UI\API\Controllers\AttachPermissionsToUserController;
use Illuminate\Support\Facades\Route;

Route::post('users/{id}/permissions/attach', [AttachPermissionsToUserController::class, 'attachPermissionsToUser'])
    ->middleware(['auth:api']);

