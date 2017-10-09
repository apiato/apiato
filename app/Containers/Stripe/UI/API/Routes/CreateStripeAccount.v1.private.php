<?php

/**
 * @apiGroup           Stripe
 * @apiName            createStripeAccount
 * @api                {post} /v1/user/payments/accounts/stripe Create Stripe Account
 * @apiDescription     Before calling this endpoint make sure to call Stripe first and get the `customer_id`.
 *                     You may use "Stripe Checkout" or "Stripe.js" to make your Stripe call. This Information
 *                     will be used to charge the user whenever he to purchase anything on the platform.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String} customer_id
 * @apiParam           {String} card_id
 * @apiParam           {String} card_funding
 * @apiParam           {String} card_last_digits
 * @apiParam           {String} card_fingerprint
 * @apiParam           {String} nickname payment nickname for your usage
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
{
   "message":"Stripe account created successfully.",
   "stripe_account_id":1
}
 */

$router->post('/user/payments/accounts/stripe', [
    'as' => 'api_stripe_create_stripe_account',
    'uses' => 'Controller@createStripeAccount',
    'middleware' => [
        'auth:api',
    ],
]);
