<?php

namespace App\Portainers\Payments\Tests;

use App\Containers\Stripe\Actions\CreateStripeAccountAction;
use App\Containers\Stripe\Services\ChargeWithStripeService;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;
use App\Portainers\Payments\Portals\PaymentsFactory;
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
        App::make(CreateStripeAccountAction::class)->run(
            $user, 'cus_8mBD5S1SoyD4zL', 'card_18Uck6KFvMcBUkvQorbBkYhR', 'credit', '4242', 'WsNM4K8puHbdS2VP'
        );

        $chargeId = 'ch_z8WDARKFvzcBUkvQzrbBvfhz';

        // mock the ChargeWithStripeService external API call
        $this->mock(ChargeWithStripeService::class)->shouldReceive('charge')->andReturn([
            'payment_method' => 'stripe',
            'description'    => $chargeId
        ]);

        $paymentsFactory = new PaymentsFactory();
        $result = $paymentsFactory->charge($user, 1000, 'USD');

        $this->assertEquals($result['payment_method'], 'stripe');
        $this->assertEquals($result['description'], $chargeId);
    }

}
