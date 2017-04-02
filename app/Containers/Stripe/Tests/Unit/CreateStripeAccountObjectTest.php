<?php

namespace App\Containers\Stripe\Tests\Unit;

use App\Containers\Stripe\Tasks\CreateStripeAccountObjectTask;
use App\Containers\Stripe\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class CreateStripeAccountObjectTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountObjectTest extends TestCase
{

    public function testCreateStripeAccountObject()
    {
        // get the logged in user (create one if no one is logged in)
        $user = $this->getTestingUser();

        // create stripe account for this user
        $createStripeAccountAction = App::make(CreateStripeAccountObjectTask::class);
        $stripeAccount = $createStripeAccountAction->run($user, 'cus_8mBD5S1SoyD4zL', 'card_18Uck6KFvMcBUkvQorbBkYhR', 'credit', '4242', 'WsNM4K8puHbdS2VP');

        $this->assertDatabaseHas('stripe_accounts', ['user_id' => $user->id]);
    }

}
