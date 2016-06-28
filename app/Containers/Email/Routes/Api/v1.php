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
    'uses'       => 'SetUserEmailController@handle',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Emails
 * @apiName            ConfirmUserEmailController
 * @api                {get} /users/{id}/email/confirmation/{code} you do not have to touch this endpoint
 * @apiDescription     confirm the email address (the user will receive an email with this endpoint to confirm his email)
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json
 */
$router->get('/users/{id}/email/confirmation/{code}', [
    'uses' => 'ConfirmUserEmailController@handle',
]);
