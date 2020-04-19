<?php

namespace App\Containers\Stripe\Tests\Unit;

use App\Containers\Payment\Tasks\AssignPaymentAccountToUserTask;
use App\Containers\Payment\Traits\MockablePaymentsTrait;
use App\Containers\Stripe\Models\StripeAccount;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class ChargeUserWithStripeTest
 *
 * @group stripe
 * @group unit
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ChargeUserWithStripeTest extends TestCase
{

    use MockablePaymentsTrait;

    /**
     * @test
     */
    public function testChargeUserWithStripe()
    {
        // Mock the payments
        $this->mockPayments();

        // create testing user
        $user = $this->getTestingUser();

        $stripeAccount = factory(StripeAccount::class)->create([
            'customer_id' => 'cus_8mBD5S1SoyD4zL',
        ]);

        App::make(AssignPaymentAccountToUserTask::class)->run($stripeAccount, $user, 'nickname');

        $amount = 100;

        // Start the test:
        $account = $user->paymentAccounts->first();

        $transaction = $user->charge($account, $amount);

        $this->assertEquals($transaction->gateway, 'Stripe');
    }
}
