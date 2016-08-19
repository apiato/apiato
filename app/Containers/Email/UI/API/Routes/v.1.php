<?php

/*********************************************************************************
 * @apiGroup           Emails
 * @apiName            SetUserEmailController
 * @api                {post} /users/{id}/email Update User Email
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


/*********************************************************************************
 * @apiGroup           Emails
 * @apiName            SetVisitorEmailController
 * @api                {post} /visitors/email Set visitor Email
 * @apiVersion         1.0.0
 * @apiPermission      visitor
 * @apiHeader          Accept application/json (required)
 * @apiParam           {String}     email
 */
$router->post('/visitors/email', [
    'uses'       => 'Controller@SetVisitorEmailController',
    'middleware' => [
        'api.auth.visitor',
    ],
]);
