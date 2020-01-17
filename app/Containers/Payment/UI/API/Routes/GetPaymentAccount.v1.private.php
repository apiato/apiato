<?php

/**
 * @apiGroup           Payment
 * @apiName            getPaymentAccount
 *
 * @api                {GET} /v1/user/paymentaccounts/:id Find Payment Account by ID
 * @apiDescription     Find Details for a specific payment account. Note that this outputs respective "visible" fields
 *                     from the model of the Payment Provider (e.g., Paypal)
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // ...
}
 */

$router->get('user/paymentaccounts/{id}', [
    'as' => 'api_payment_get_payment_account',
    'uses'  => 'Controller@getPaymentAccount',
    'middleware' => [
      'auth:api',
    ],
]);
