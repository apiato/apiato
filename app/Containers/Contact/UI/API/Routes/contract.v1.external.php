<?php

/*********************************************************************************
 * @apiGroup           Emails
 * @apiName            ContactUs
 * @api                {post} /contact Contact Us form
 * @apiVersion         1.0.0
 * @apiPermission      visitor
 * @apiHeader          Accept application/json (required)
 * @apiHeader          visitor-id The Device ID [12345] (required)
 * @apiParam           {String} email (required)
 * @apiParam           {String} message (required)
 * @apiParam           {String} name (optional)
 * @apiParam           {String} subject (optional)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 202 Accepted
{
"message": "Message sent Successfully."
}
 */
$router->post('/contact', [
    'uses'       => 'Controller@contactUs',
    'middleware' => [
        'api.auth.visitor',
    ],
]);
