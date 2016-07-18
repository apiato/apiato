<?php


/*********************************************************************************
 * @apiGroup           Stripe
 * @apiName            createStripeAccount
 * @api                {post} /stripes Save Stripe Information
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
]);
