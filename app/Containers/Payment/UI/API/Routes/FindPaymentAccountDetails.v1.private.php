<?php

/**
 * @apiGroup           Payment
 * @apiName            getPaymentAccountDetails
 *
 * @api                {GET} /v1/user/paymentaccounts/:id Find Payment Account Details
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
  // Insert the response of the request here...
}
 */

$router->get('user/paymentaccounts/{id}', [
    'as' => 'API_Payment_getPaymentAccountDetails',
    'uses'  => 'Controller@getPaymentAccountDetails',
    'middleware' => [
      'auth:api',
    ],
]);
