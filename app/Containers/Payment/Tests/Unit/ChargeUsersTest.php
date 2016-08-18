<?php

namespace App\Containers\Payment\Tests\Unit;

use App\Containers\Payment\Factories\PaymentsFactory;
use App\Containers\Paypal\Tasks\CreatePaypalAccountObjectTask;
use App\Containers\Paypal\Tasks\ChargeWithPaypalTask;
use App\Containers\Stripe\Tasks\CreateStripeAccountObjectTask;
use App\Containers\Stripe\Tasks\ChargeWithStripeTask;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class ChargeUsersTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ChargeUsersTest extends TestCase
{

    public function testChargeWithStripe()
    {
        // get the logged in user (create one if no one is logged in)
        $user = $this->registerAndLoginTestingUser();

        // create stripe account for this user
        $createStripeAccountAction = App::make(CreateStripeAccountObjectTask::class);
        $stripeAccount = $createStripeAccountAction->run($user, 'cus_8mBD5S1SoyD4zL', 'card_18Uck6KFvMcBUkvQorbBkYhR', 'credit', '4242', 'WsNM4K8puHbdS2VP');

        $payId = 'ch_z8WDARKFvzcBUkvQzrbBvfhz';

        // mock the ChargeWithStripeTask external API call
        $this->mock(ChargeWithStripeTask::class)->shouldReceive('charge')->andReturn([
            'payment_method' => 'stripe',
            'description'    => $payId
        ]);

        $paymentsFactory = new PaymentsFactory();
        $result = $paymentsFactory->charge($user, 1000, 'USD');

        $this->assertEquals($result['payment_method'], 'stripe');
        $this->assertEquals($result['description'], $payId);
    }

    public function testChargeWithPaypal()
    {
        // get the logged in user (create one if no one is logged in)
        $user = $this->registerAndLoginTestingUser();

        // create stripe account for this user
        $createPaypalAccountAction = App::make(CreatePaypalAccountObjectTask::class);
        $paypalAccount = $createPaypalAccountAction->run($user, '8mBD5S1SoyD4zL');

        $payId = 'PAY-04797768K5905283VK6DGEMZ';

        // mock the ChargeWithPaypalTask external API call
        $this->mock(ChargeWithPaypalTask::class)->shouldReceive('charge')->andReturn([
            'payment_method' => 'paypal',
            'description'    => $payId
        ]);

        // TODO: comment out the pocking part above and test the real API call

        $paymentsFactory = new PaymentsFactory();
        $result = $paymentsFactory->charge($user, 1000, 'USD');

        $this->assertEquals($result['payment_method'], 'paypal');
        $this->assertEquals($result['description'], $payId);
    }

}
