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
{
}
 */

$router->delete('settings/{id}', [
    'as' => 'api_settings_delete_setting',
    'uses'  => 'Controller@deleteSetting',
    'middleware' => [
      'auth:api',
    ],
]);
