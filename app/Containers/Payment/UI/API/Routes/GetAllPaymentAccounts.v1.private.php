<?php

/**
 * @apiGroup           Payment
 * @apiName            getPaymentAccounts
 *
 * @api                {GET} /v1/user/paymentaccounts Get All Payment Accounts
 * @apiDescription     Get All Payment Accounts for this user
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 * // Insert the response of the request here...
 * }
 */

use App\Containers\Payment\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('user/paymentaccounts', [Controller::class, 'getAllPaymentAccounts'])
    ->name('api_payment_get_payment_accounts')
    ->middleware(['auth:api']);
