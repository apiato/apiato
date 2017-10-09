<?php

/**
 * @apiGroup           Users
 * @apiName            getAllClients
 * @api                {get} /v1/clients Get All Client Users
 * @apiDescription     Get All Users where role `Client`.
 *                     You can search for Users by email, name and ID.
 *                     Example: `?search=Mahmoud` or `?search=whatever@mail.com`.
 *                     You can specify the field as follow `?search=email:whatever@mail.com` or `?search=id:20`.
 *                     You can search by multiple fields as follow: `?search=name:Mahmoud&email:whatever@mail.com`.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

$router->get('clients', [
    'as' => 'api_user_get_all_clients',
    'uses'       => 'Controller@getAllClients',
    'middleware' => [
        'auth:api',
    ],
]);
