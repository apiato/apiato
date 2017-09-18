<?php

/**
 * @apiGroup           Stripe
 * @apiName            updateStripeAccount
 *
 * @api                {PATCH} /v1/user/paymentaccounts/stripe/:id Update Stripe Account
 * @apiDescription     Update a stripe account.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

$router->patch('user/paymentaccounts/stripe/{id}', [
    'as' => 'API_Stripe_updateStripeAccount',
    'uses'  => 'Controller@updateStripeAccount',
    'middleware' => [
      'auth:api',
    ],
]);
