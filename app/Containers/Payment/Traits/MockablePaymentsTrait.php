<?php

namespace App\Containers\Payment\Traits;

use App\Containers\Payment\Models\PaymentTransaction;

/**
 * Class MockablePaymentsTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait MockablePaymentsTrait
{

    public function mockPayments()
    {
        // Mock Stripe charging
        if (class_exists($chargeWithStripeTask = \App\Containers\Stripe\Tasks\ChargeWithStripeTask::class)) {
            $this->mockIt($chargeWithStripeTask)
                 ->shouldReceive('charge')
                 ->andReturn(new PaymentTransaction([
                        'user_id' => 1,

                        'gateway' => 'Stripe',
                        'transaction_id' => 'tx_1234567890',
                        'status' => 'success',
                        'is_successful' => true,

                        'amount' => '100',
                        'currency' => 'USD',

                        'data' => [],
                        'custom' => [],
                    ])
                 );
        }

    }
}
