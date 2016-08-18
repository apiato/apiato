<?php

namespace App\Containers\Stripe\Tests\Unit;

use App\Containers\Paypal\Tasks\CreatePaypalAccountObjectTask;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class CreatePaypalAccountObjectTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreatePaypalAccountObjectTest extends TestCase
{

    public function testCreatePaypalAccountObject()
    {
        // get the logged in user (create one if no one is logged in)
        $user = $this->registerAndLoginTestingUser();

        // create stripe account for this user
        $createPaypalAccountAction = App::make(CreatePaypalAccountObjectTask::class);
        $paypalAccount = $createPaypalAccountAction->run($user, '8mBD5S1SoyD4zL');

        $this->seeInDatabase('paypal_accounts', ['user_id' => $user->id]);
    }

}
