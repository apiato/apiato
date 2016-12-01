<?php

namespace App\Containers\Paypal\Actions;

use App\Containers\Paypal\Tasks\CreatePaypalAccountObjectTask;
use App\Containers\User\Models\User;
use App\Port\Action\Abstracts\Action;
use Auth;

/**
 * Class CreatePaypalAccountAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreatePaypalAccountAction extends Action
{

    /**
     * @var  \App\Containers\Paypal\Tasks\CreatePaypalAccountObjectTask
     */
    private $createPaypalAccountObjectTask;

    /**
     * CreatePaypalAccountAction constructor.
     *
     * @param \App\Containers\Paypal\Tasks\CreatePaypalAccountObjectTask $createPaypalAccountObjectTask
     */
    public function __construct(CreatePaypalAccountObjectTask $createPaypalAccountObjectTask)
    {
        $this->createPaypalAccountObjectTask = $createPaypalAccountObjectTask;
    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $customer_id
     * @param                                  $card_id
     * @param                                  $card_funding
     * @param                                  $card_last_digits
     * @param                                  $card_fingerprint
     *
     * @return  \App\Containers\Paypal\Models\PaypalAccount|mixed
     */
    public function run(User $user, $some_id)
    {
        // TODO: To Be Continue...
        $paypalAccount = $this->createPaypalAccountObjectTask->run($user, $some_id);

        return $paypalAccount;
    }

}
