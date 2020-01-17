<?php

/**
 * @apiGroup           Payment
 * @apiName            updatePaymentAccount
 *
 * @api                {PATCH} /v1/user/paymentaccounts/:id Update Payment Account
 * @apiDescription     Updates a single Payment Account. Does NOT (!) update the account credentials from the respective
 *                     payment gateway (e.g., Paypal).
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

$router->patch('user/paymentaccounts/{id}', [
    'as' => 'api_payment_update_payment_account',
    'uses'  => 'Controller@updatePaymentAccount',
    'middleware' => [
      'auth:api',
    ],
]);
