<?php

namespace App\Containers\Paypal\Actions;

use App\Containers\Paypal\Tasks\CreatePaypalAccountTask;
use App\Containers\User\Models\User;
use App\Port\Action\Abstracts\Action;
use Auth;

/**
 * Class CreatePaypalAccountAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePaypalAccountAction extends Action
{

    /**
     * @var  \App\Containers\Paypal\Data\Repositories\CreatePaypalAccountTask
     */
    private $createPaypalAccountTask;

    /**
     * CreatePaypalAccountAction constructor.
     *
     * @param \App\Containers\Paypal\Data\Repositories\CreatePaypalAccountTask $createPaypalAccountTask
     */
    public function __construct(CreatePaypalAccountTask $createPaypalAccountTask)
    {
        $this->createPaypalAccountTask = $createPaypalAccountTask;
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
        $paypalAccount = $this->createPaypalAccountTask->run($user, $some_id);

        return $paypalAccount;
    }

}
