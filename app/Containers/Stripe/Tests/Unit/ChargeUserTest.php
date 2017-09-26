<?php

namespace App\Containers\Srtipe\Tests\Unit;

use App\Containers\Payment\Tasks\AssignPaymentAccountToUserTask;
use App\Containers\Payment\Traits\MockablePaymentsTrait;
use App\Containers\Stripe\Models\StripeAccount;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class ChargeUserTest
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ChargeUserTest extends TestCase
{

    use MockablePaymentsTrait;

    public function testChargeUser_()
    {
        // Mock the payments
        $this->mockPayments();

        // create testing user
        $user = $this->getTestingUser([
            'total_credits' => 10000
        ]);

        $stripeAccount = factory(StripeAccount::class)->create([
            'customer_id' => 'cus_8mBD5S1SoyD4zL',
        ]);

        App::make(AssignPaymentAccountToUserTask::class)->run($stripeAccount, $user, ['name' => 'stripe']);

        $amount = 100;

        // Star the test:

        $acccount = $user->paymentAccounts->first();

        $stripeResponse = $user->charge($acccount, $amount);

        $this->assertEquals($stripeResponse['payment_method'], 'stripe');
    }
}
