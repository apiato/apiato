<?php

namespace App\Containers\Stripe\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateStripeAccountAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {

        $user = $this->call('Authentication@GetAuthenticatedUserTask');

        $data = $request->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
            'nickname',
        ]);

        $account = $this->call('Stripe@CreateStripeAccountTask', [$data]);

        $result = $this->call('Payment@AssignPaymentAccountToUserTask', [$account, $user, $data['nickname']]);

        return $result;
    }

}
