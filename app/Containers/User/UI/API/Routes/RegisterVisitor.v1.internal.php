<?php

/**
 * @apiGroup           Users
 * @apiName            registerVisitor
 * @api                {post} /visitor/register Register visitor (even if he exist)
 * @apiDescription     This endpoint must be called on App startup. (when the App
 * allows using it before registering). The endpoint will create a user record
 * if not already exist based on his unique visitor-id (A.K.A device ID) and return
 * the `User ID`. Later when the user is required to register, we simply
 * update his existing record with his information (email, password,...).
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiHeader          visitor-id The Device ID [12345] (required)
 * @apiUse             SingleUserSuccessResponse
 */

$router->post('visitor/register', [
    'uses'  => 'Controller@registerVisitor',
]);
