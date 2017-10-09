<?php

/**
 * @apiGroup           Stripe
 * @apiName            updateStripeAccount
 *
 * @api                {PATCH} /v1/user/payments/accounts/stripe/:id Update Stripe Account
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

<<<<<<< HEAD
$router->patch('user/paymentaccounts/stripe/{id}', [
    'as' => 'api_stripe_update_stripe_account',
=======
$router->patch('user/payments/accounts/stripe/{id}', [
    'as' => 'API_Stripe_updateStripeAccount',
>>>>>>> apiato
    'uses'  => 'Controller@updateStripeAccount',
    'middleware' => [
      'auth:api',
    ],
]);
