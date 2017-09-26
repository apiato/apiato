<?php

namespace App\Containers\Payment\Traits;

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
            $this->mock($chargeWithStripeTask)->shouldReceive('charge')->andReturn([
                'payment_method' => 'stripe',
                'description'    => '1'
            ]);
        }

    }
}
