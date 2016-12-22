<?php

/*********************************************************************************
 * @apiGroup           Applications
 * @apiName            listUserApplications
 * @api                {post} /apps List all user Apps
 * @apiDescription     List all your user Apps and their Tokens
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User (with Developer role)
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 Ok
{
   "data":[
      {
         "object":"Application",
         "id":"qrvzpjzb",
         "name":"Dante Kunze",
         "token":"1234567890",
         "created_at":{
            "date":"2016-12-22 18:03:41.000000",
            "timezone_type":3,
            "timezone":"UTC"
         }
      },
      {
         "object":"Application",
         "id":"oplzqrmw",
         "name":"Gaylord Orn",
         "token":"1234567890",
         "created_at":{
            "date":"2016-12-22 18:03:41.000000",
            "timezone_type":3,
            "timezone":"UTC"
         }
      },
      {
         "object":"Application",
         "id":"wvpzjamr",
         "name":"Ansel Altenwerth DDS",
         "token":"1234567890",
         "created_at":{
            "date":"2016-12-22 18:03:41.000000",
            "timezone_type":3,
            "timezone":"UTC"
         }
      },
      ...
   ]
}
 */
$router->get('apps', [
    'uses'       => 'Controller@listUserApplications',
    'middleware' => [
        'api.auth',
        'role:developer',
    ],
]);
