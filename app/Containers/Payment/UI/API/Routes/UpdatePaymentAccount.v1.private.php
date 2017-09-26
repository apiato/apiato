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
    // TODO: Insert the response of the request here.
}
 */

$router->patch('user/paymentaccounts/{id}', [
    'as' => 'API_Payment_updatePaymentAccount',
    'uses'  => 'Controller@updatePaymentAccount',
    'middleware' => [
      'auth:api',
    ],
]);
