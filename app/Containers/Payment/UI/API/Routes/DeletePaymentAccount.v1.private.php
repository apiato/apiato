<?php

/**
 * @apiGroup           Payment
 * @apiName            deletePaymentAccount
 *
 * @api                {DELETE} /v1/user/paymentaccounts/:id Delete Payment Account
 * @apiDescription     Deletes a payment account. Also deletes the corresponding model with the account details (e.g.,
 *                     for stripe, ...)
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

$router->delete('user/paymentaccounts/{id}', [
    'as' => 'API_Payment_deletePaymentAccount',
    'uses'  => 'Controller@deletePaymentAccount',
    'middleware' => [
      'auth:api',
    ],
]);
