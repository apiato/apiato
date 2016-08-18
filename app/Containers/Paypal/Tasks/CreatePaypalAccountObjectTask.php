<?php

namespace App\Containers\Paypal\Tasks;

use App\Containers\Paypal\Data\Repositories\PaypalAccountRepository;
use App\Containers\Paypal\Models\PaypalAccount;
use App\Containers\User\Models\User;
use App\Port\Task\Abstracts\Task;
use Auth;

/**
 * Class CreatePaypalAccountObjectTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePaypalAccountObjectTask extends Task
{

    /**
     * @var  \App\Containers\Paypal\Data\Repositories\PaypalAccountRepository
     */
    private $paypalAccountRepository;

    /**
     * CreatePaypalAccountTask constructor.
     *
     * @param \App\Containers\Paypal\Data\Repositories\PaypalAccountRepository $paypalAccountRepository
     */
    public function __construct(PaypalAccountRepository $paypalAccountRepository)
    {
        $this->paypalAccountRepository = $paypalAccountRepository;
    }

    /**
     * Create paypal account in my database
     *
     * @param \App\Containers\User\Models\User $user
     * @param                                  $some_id
     *
     * @return  \App\Containers\Paypal\Models\PaypalAccount|mixed
     */
    public function run(User $user, $some_id)
    {
        $paypalAccount = new PaypalAccount();
        $paypalAccount->some_id = $some_id; // TODO: To Be Continue...
        $paypalAccount->user()->associate($user);

        $paypalAccount = $this->paypalAccountRepository->create($paypalAccount->toArray());

        return $paypalAccount;
    }

}
