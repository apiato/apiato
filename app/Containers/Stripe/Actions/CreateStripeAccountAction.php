<?php

namespace App\Containers\Stripe\Actions;

use App\Containers\Stripe\Tasks\CreateStripeAccountObjectTask;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreateStripeAccountAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountAction extends Action
{

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $customer_id
     * @param                                  $card_id
     * @param                                  $card_funding
     * @param                                  $card_last_digits
     * @param                                  $card_fingerprint
     *
     * @return  mixed
     */
    public function run(User $user, $customer_id, $card_id, $card_funding, $card_last_digits, $card_fingerprint)
    {
        $stripeAccount = $this->call(CreateStripeAccountObjectTask::class, [
            $user,
            $customer_id,
            $card_id,
            $card_funding,
            $card_last_digits,
            $card_fingerprint
        ]);

        return $stripeAccount;
    }

}
