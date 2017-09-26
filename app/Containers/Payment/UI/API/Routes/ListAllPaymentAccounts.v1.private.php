<?php

/**
 * @apiGroup           Payment
 * @apiName            listAllPaymentAccounts
 *
 * @api                {GET} /v1/user/paymentaccounts Get Payment Accounts
 * @apiDescription     Get all Payment Accounts for this user
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

$router->get('user/paymentaccounts', [
    'as' => 'API_Payment_listAllPaymentAccounts',
    'uses'  => 'Controller@listAllPaymentAccounts',
    'middleware' => [
      'auth:api',
    ],
]);
