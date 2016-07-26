<?php

/*********************************************************************************
 * @apiGroup           Emails
 * @apiName            SetUserEmailController
 * @api                {post} /users/{id}/email Update User Email
 * @apiDescription     Set an email for the User
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParam           {String} email
 * @apiParam           {Number} id the user id in the uri (required)
 */
$router->post('/users/{id}/email', [
    'uses'       => 'Controller@setUserEmailController',
    'middleware' => [
        'api.auth',
    ],
]);
