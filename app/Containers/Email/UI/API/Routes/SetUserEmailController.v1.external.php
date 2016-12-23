<?php

/**
 * @apiGroup           Emails
 * @apiName            SetUserEmailController
 * @api                {post} /users/email Update User Email
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 *
 * @apiParam           {String} email
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
   "message":"User Email Saved Successfully."
}
 */

$router->post('/users/email', [
    'uses'       => 'Controller@setUserEmailController',
    'middleware' => [
        'api.auth',
    ],
]);
