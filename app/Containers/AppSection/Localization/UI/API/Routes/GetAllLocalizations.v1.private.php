<?php

/**
 * @apiGroup           Localization
 * @apiName            getAllLocalizations
 *
 * @api                {GET} /v1/localizations Get all localizations
 * @apiDescription     Return all available localizations that are "configured" in the application
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": [
    {
        "object": "Localization",
      "id": "ar",
      "language": {
        "code": "ar",
        "default_name": "Arabic",
        "locale_name": "العربية"
      },
      "regions": []
    },
    {
        "object": "Localization",
      "id": "en",
      "language": {
        "code": "en",
        "default_name": "English",
        "locale_name": "English"
      },
      "regions": [
        {
            "code": "en-GB",
          "default_name": "United Kingdom",
          "locale_name": "United Kingdom"
        },
        {
            "code": "en-US",
          "default_name": "United States",
          "locale_name": "United States"
        }
      ]
    }
  ],
  "meta": {
    "include": [],
    "custom": []
  }
}
 */

use App\Containers\AppSection\Localization\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('localizations', [Controller::class, 'getAllLocalizations'])
    ->name('api_localization_get_all_localizations')
    ->middleware(['auth:api']);
