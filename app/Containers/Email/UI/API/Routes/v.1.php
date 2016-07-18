<?php

/*********************************************************************************
 * @apiGroup           Emails
 * @apiName            SetUserEmailController
 * @api                {post} /users/{id}/email
 * @apiDescription     Set an email for the User
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ91QiLCJhbGciOiJIUzI1NiJ1...
 * @apiParam           {String}     email
 */
$router->post('/users/{id}/email', [
    'uses'       => 'Controller@setUserEmailController',
    'middleware' => [
        'api.auth',
    ],
]);
