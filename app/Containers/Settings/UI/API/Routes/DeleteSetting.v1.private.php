<?php

/**
 * @apiGroup           Settings
 * @apiName            deleteSetting
 *
 * @api                {DELETE} /v1/settings/:id Delete Setting
 * @apiDescription     Deletes a setting entry
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 OK
 * {
 * }
 */

use App\Containers\Settings\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('settings/{id}', [Controller::class, 'deleteSetting'])
    ->name('api_settings_delete_setting')
    ->middleware(['auth:api']);
