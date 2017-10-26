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
{
  // TODO..
}
 */

$router->get('localizations', [
    'as' => 'api_localization_get_all_localizations',
    'uses'  => 'Controller@getAllLocalizations',
    'middleware' => [
      'auth:api',
    ],
]);
