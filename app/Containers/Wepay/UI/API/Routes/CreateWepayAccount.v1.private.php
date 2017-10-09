<?php

/**
 * @apiGroup           wepay
 * @apiName            createWepayAccount
 * @api                {post} /v1/user/payments/accounts/wepay Create wepay Account
 * @apiDescription     Before calling this endpoint make sure to call wepay first and get the `customer_id`.
 *                     You may use "Wepay Checkout" or "wepay.js" to make your Wepay call. This Information
 *                     will be used to charge the User whenever he to purchase anything on the platform.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String} name
 * @apiParam           {String} description
 * @apiParam           {String} type
 * @apiParam           {String} imageUrl
 * @apiParam           {String} gaqDomains
 * @apiParam           {String} mcc
 * @apiParam           {String} country
 * @apiParam           {String} currencies
 * @apiParam           {String} nickname
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
{
   "message":"wepay account created successfully.",
   "wepay_account_id":1
}
 */

$router->post('/user/payments/accounts/wepay', [
    'as' => 'api_wepay_create_wepay_account',
    'uses' => 'Controller@createWepayAccount',
    'middleware' => [
        'auth:api',
    ],
]);
