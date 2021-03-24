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
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 * // ...
 * }
 */

use App\Containers\Payment\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('user/paymentaccounts/{id}', [Controller::class, 'getPaymentAccount'])
    ->name('api_payment_get_payment_account')
    ->middleware(['auth:api']);
