<?php

/**
 * @apiGroup           Authentication
 * @apiName            UserLogin
 * @api                {post} /user/login Login a user
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiParam           {String}     email (required)
 * @apiParam           {String}     password (required)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 200 OK
{

}
 */

$router->post('user/login', [
    'uses' => 'Controller@userLogin',
]);
