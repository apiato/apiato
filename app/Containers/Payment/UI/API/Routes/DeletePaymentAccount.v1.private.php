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
    // ...
}
 */

$router->delete('user/paymentaccounts/{id}', [
    'as' => 'api_payment_delete_payment_account',
    'uses'  => 'Controller@deletePaymentAccount',
    'middleware' => [
      'auth:api',
    ],
]);
