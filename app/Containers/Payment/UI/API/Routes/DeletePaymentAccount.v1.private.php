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
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 * // ...
 * }
 */

use App\Containers\Payment\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('user/paymentaccounts/{id}', [Controller::class, 'deletePaymentAccount'])
    ->name('api_payment_delete_payment_account')
    ->middleware(['auth:api']);

