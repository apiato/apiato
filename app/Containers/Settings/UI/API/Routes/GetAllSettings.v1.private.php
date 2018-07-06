<?php

/**
 * @apiGroup           Settings
 * @apiName            getAllSettings
 *
 * @api                {GET} /v1/settings Get All Settings
 * @apiDescription     Get All settings for the application
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": [
        {
            "object": "Setting",
            "id": "damq35egme74k0xv",
            "key": "foo",
            "value": "bar"
        },
        {
            "object": "Setting",
            "id": "damq35egme74k0xv",
            "key": "test",
            "value": "456"
        },
        {
            "object": "Setting",
            "id": "damq35egme74k0xv",
            "key": "logout",
            "value": "false"
        }
    ],
    "meta": {

    }
}
 */

$router->get('settings', [
    'as' => 'api_settings_get_all_settings',
    'uses'  => 'Controller@getAllSettings',
    'middleware' => [
      'auth:api',
    ],
]);
