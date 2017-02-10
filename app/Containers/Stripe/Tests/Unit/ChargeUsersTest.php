<?php

namespace App\Containers\Stripe\Tests\Unit;

use App\Containers\Stripe\Tasks\CreateStripeAccountObjectTask;
use App\Containers\Stripe\Tasks\ChargeWithStripeTask;
use App\Port\Test\PHPUnit\Abstracts\TestCase;
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
        $user = $this->createTestingUser();

        // create stripe account for this user
        $createStripeAccountAction = App::make(CreateStripeAccountObjectTask::class);
        $stripeAccount = $createStripeAccountAction->run($user, 'cus_8mBD5S1SoyD4zL', 'card_18Uck6KFvMcBUkvQorbBkYhR', 'credit', '4242', 'WsNM4K8puHbdS2VP');

        $payId = 'ch_z8WDARKFvzcBUkvQzrbBvfhz';

        // mock the ChargeWithStripeTask external API call
        $this->mock(ChargeWithStripeTask::class)->shouldReceive('charge')->andReturn([
            'payment_method' => 'stripe',
            'description'    => $payId
        ]);

        $stripe = App::make(ChargeWithStripeTask::class);
        $result = $stripe->charge($user, 1000, 'USD');

        $this->assertEquals($result['payment_method'], 'stripe');
        $this->assertEquals($result['description'], $payId);
    }

}
