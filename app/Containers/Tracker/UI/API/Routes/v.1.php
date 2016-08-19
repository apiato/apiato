<?php
/*********************************************************************************
 * @apiGroup           Tracker
 * @apiName            trackOpen
 * @api                {post} /track/open Track App open
 * @apiDescription     Call this Endpoint when the user first open the app
 * @apiVersion         1.0.0
 * @apiPermission      Visitor
 * @apiHeader          Accept application/json (required)
 * @apiHeader          visitor-id The Device ID [12345] (optional)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 202 Accepted

{
   "message": "Session (open) Tracked Successfully."
}
 */
$router->post('track/open', [
    'uses' => 'Controller@trackOpen',
    'middleware' => [
        'api.auth.visitor',
    ],
]);

/*********************************************************************************
 * @apiGroup           Tracker
 * @apiName            trackClose
 * @api                {post} /track/close Track App close
 * @apiDescription     Call this Endpoint when the user closes the app
 * @apiVersion         1.0.0
 * @apiPermission      Visitor
 * @apiHeader          Accept application/json (required)
 * @apiHeader          visitor-id The Device ID [12345] (optional)
 * @apiSuccessExample  {json}       Success-Response:
HTTP/1.1 202 Accepted

{
   "message": "Session (close) Tracked Successfully."
}
 */
$router->post('track/close', [
    'uses' => 'Controller@trackClose',
    'middleware' => [
        'api.auth.visitor',
    ],
]);
