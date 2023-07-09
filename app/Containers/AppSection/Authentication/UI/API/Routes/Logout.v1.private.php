<?php
/**
 * @apiGroup           OAuth2
 *
 * @apiName            Logout
 *
 * @api                {post} /v1/api/logout Logout
 *
 * @apiDescription     User Logout. (Revoking Access Token)
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 Accepted
 * {
 * "message": "Token revoked successfully."
 * }
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\ApiLogoutController;
use Illuminate\Support\Facades\Route;

Route::post('api/logout', ApiLogoutController::class)
    ->middleware(['auth:api']);
