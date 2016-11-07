<?php

namespace App\Containers\Stripe\Actions;

use App\Containers\Stripe\Tasks\CreateStripeAccountObjectTask;
use App\Containers\User\Models\User;
use App\Port\Action\Abstracts\Action;
use Auth;

/**
 * Class CreateStripeAccountAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountAction extends Action
{

    /**
     * @var  \App\Containers\Stripe\Tasks\CreateStripeAccountObjectTask
     */
    private $createStripeAccountObjectTask;

    /**
     * CreateStripeAccountAction constructor.
     *
     * @param \App\Containers\Stripe\Tasks\CreateStripeAccountObjectTask $createStripeAccountObjectTask
     */
    public function __construct(CreateStripeAccountObjectTask $createStripeAccountObjectTask)
    {
        $this->createStripeAccountObjectTask = $createStripeAccountObjectTask;
    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $customer_id
     * @param                                  $card_id
     * @param                                  $card_funding
     * @param                                  $card_last_digits
     * @param                                  $card_fingerprint
     *
     * @return  \App\Containers\Stripe\Models\StripeAccount|mixed
     */
    public function run(User $user, $customer_id, $card_id, $card_funding, $card_last_digits, $card_fingerprint)
    {
        $stripeAccount = $this->createStripeAccountObjectTask->run(
            $user,
            $customer_id,
            $card_id,
            $card_funding,
            $card_last_digits,
            $card_fingerprint
        );

        return $stripeAccount;
    }

}
