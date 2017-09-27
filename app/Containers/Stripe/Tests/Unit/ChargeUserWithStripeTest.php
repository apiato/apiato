<?php

namespace App\Containers\Srtipe\Tests\Unit;

use App\Containers\Payment\Tasks\AssignPaymentAccountToUserTask;
use App\Containers\Payment\Traits\MockablePaymentsTrait;
use App\Containers\Stripe\Models\StripeAccount;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class ChargeUserWithStripeTest
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ChargeUserWithStripeTest extends TestCase
{

    use MockablePaymentsTrait;

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

        // Star the test:

        $account = $user->paymentAccounts->first();

        $stripeResponse = $user->charge($account, $amount);

        $this->assertEquals($stripeResponse['payment_method'], 'stripe');
    }
}
