<?php

/**
 * @apiGroup           Stripe
 * @apiName            createStripeAccount
 * @api                {post} /v1/stripes Create Stripe Account
 * @apiDescription     Before calling this endpoint make sure to call Stripe first and get the `customer_id`.
 *                     You may use "Stripe Checkout" or "Stripe.js" to make your Stripe call. This Information
 *                     will be used to charge the user whenever he to purchase anything on the platform.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           customer_id
 * @apiParam           card_id
 * @apiParam           card_funding
 * @apiParam           card_last_digits
 * @apiParam           card_fingerprint
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
{
   "message":"Stripe account created successfully.",
   "stripe_account_id":1
}
 */

$router->post('/stripes', [
    'uses' => 'Controller@createStripeAccount',
    'middleware' => [
        'auth:api',
    ],
]);
