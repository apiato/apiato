<?php

/**
 * @apiGroup           Payment
 * @apiName            getPaymentAccount
 *
 * @api                {GET} /v1/user/paymentaccounts/:id Get Payment Account by ID
 * @apiDescription     Get Details for a specific payment account. Note that this outputs respective "visible" fields
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
  // TODO: Insert the response of the request here.
}
 */

$router->get('user/paymentaccounts/{id}', [
    'as' => 'API_Payment_getPaymentAccount',
    'uses'  => 'Controller@getPaymentAccount',
    'middleware' => [
      'auth:api',
    ],
]);
