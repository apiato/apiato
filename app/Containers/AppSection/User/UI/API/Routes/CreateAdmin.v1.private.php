<?php

/**
 * @apiGroup           User
 * @apiName            createAdmin
 * @api                {post} /v1/admins Create Admin type Users
 * @apiDescription     Create non client users for the Dashboard.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  password min:6|max:40
 * @apiParam           {String}  [name] min:2|max:50
 * @apiParam           {String="male,female,unspecified"}  [gender]
 * @apiParam           {Date}  [birth] format: Y-m-d / e.g. 2015-10-15
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\CreateAdminController;
use Illuminate\Support\Facades\Route;

Route::post('admins', [CreateAdminController::class, 'createAdmin'])
    ->name('api_user_create_admin')
    ->middleware(['auth:api']);
