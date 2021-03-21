<?php

/**
 * @apiGroup           Localization
 * @apiName            getAllLocalizations
 *
 * @api                {GET} /v1/localizations Get all localizations
 * @apiDescription     Return all available localizations that are "configured" in the application
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 * // TODO..
 * }
 */

use App\Containers\Localization\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('localizations', [Controller::class, 'getAllLocalizations'])
    ->name('api_localization_get_all_localizations')
    ->middleware(['auth:api']);
