<?php

/**
 * @apiGroup           Users
 * @apiName            RefreshUser
 * @api                {post} /users/refresh Refresh User data
 * @apiDescription     Request the latest user Data. You can send the
 * `token` header or `user_id` parameter to get the updated user data.
 * (You can use this Endpoint whenever the user object is updated for any reason to get
 * his updated data).
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer {User-Token} (required)
 * @apiParam           user_id User Id (optional)
 * @apiUse             SingleUserSuccessResponse
 */

$router->post('users/refresh', [
    'uses' => 'Controller@refreshUser',
    'middleware' => [
        'api.auth',
    ],
]);
