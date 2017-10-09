<?php

/**
 * @apiGroup           Users
 * @apiName            getAllAdmins
 * @api                {get} /v1/admins Get All Admin Users
 * @apiDescription     Get All Users where role `Admin`.
 *                     You can search for Users by email, name and ID.
 *                     Example: `?search=Mahmoud` or `?search=whatever@mail.com`.
 *                     You can specify the field as follow `?search=email:whatever@mail.com` or `?search=id:20`.
 *                     You can search by multiple fields as follow: `?search=name:Mahmoud&email:whatever@mail.com`.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

$router->get('admins', [
    'as' => 'api_user_get_all_admins',
    'uses'       => 'Controller@getAllAdmins',
    'middleware' => [
        'auth:api',
    ],
]);
