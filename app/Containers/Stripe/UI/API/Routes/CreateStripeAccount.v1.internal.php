<?php

/**
 * @apiGroup           Stripe
 * @apiName            createStripeAccount
 * @apiDescription     Before calling this endpoint make sure to call Stripe first and get the `customer_id`.
 *                     You may use "Stripe Checkout" or "Stripe.js" to make your Stripe call. This Information
 *                     will be used to charge the user whenever he to purchase anything on the platform.
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json
 * @apiParam           customer_id
 * @apiParam           card_id
 * @apiParam           card_funding
 * @apiParam           card_last_digits
 * @apiParam           card_fingerprint
 */

$router->post('/stripes', [
    'uses' => 'Controller@createStripeAccount',
    'middleware' => [
        'api.auth',
    ],
]);
