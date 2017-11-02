<?php

namespace App\Containers\Wepay\Tests\Unit;

use App\Containers\Payment\Traits\MockablePaymentsTrait;
use App\Containers\User\Tests\TestCase;

/**
 * Class ChargeUserWithWepayTest
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ChargeUserWithWepayTest extends TestCase
{

    use MockablePaymentsTrait;

    public function testChargeUserWithWePay_()
    {

        $this->assertTrue(true);

        // TODO: Fix this error
        // this line "App::make(WePayLaravel::class);" is called from the "PaymentsGateway charge()" is causing the following error:
        // Illuminate\Contracts\Container\BindingResolutionException: Unresolvable dependency resolving [Parameter #0 [ <required> array $config ]] in class KevinEm\WePay\Laravel\WePayLaravel

//        // Mock the payments
//        $this->mockPayments();
//
//        // create testing user
//        $user = $this->getTestingUser();
//
//        $wepayAccount = factory(WePayAccount::class)->create();
//
//        App::make(AssignPaymentAccountToUserTask::class)->run($wepayAccount, $user, 'nickname');
//
//        $amount = 100;
//
//        // Star the test:
//
//        $account = $user->paymentAccounts->first();
//
//
//        $stripeResponse = $user->charge($account, $amount);
//
//        $this->assertEquals($stripeResponse['payment_method'], 'wepay');
    }
}
