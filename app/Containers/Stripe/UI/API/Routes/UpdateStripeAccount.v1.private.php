<?php

/**
 * @apiGroup           Stripe
 * @apiName            updateStripeAccount
 *
 * @api                {PATCH} /v1/user/payments/accounts/stripe/:id Update Stripe Account
 * @apiDescription     Update a stripe account.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 * // Insert the response of the request here...
 * }
 */

use App\Containers\Stripe\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('user/payments/accounts/stripe/{id}', [Controller::class, 'updateStripeAccount'])
    ->name('api_stripe_update_stripe_account')
    ->middleware(['auth:api']);
