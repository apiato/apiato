<?php

/*********************************************************************************
 * @apiGroup           Applications
 * @apiName            createApplicationWithToken
 * @api                {post} /apps Create Application With Access Token
 * @apiDescription
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User (with Developer role)
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParameter       {string} Name (required) Application Name
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 202 Accepted
{

}
 */
$router->post('apps', [
    'uses'       => 'Controller@createApplication',
    'middleware' => [
        'api.auth',
        'role:developer',
    ],
]);
