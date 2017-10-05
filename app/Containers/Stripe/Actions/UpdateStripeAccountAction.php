<?php

namespace App\Containers\Stripe\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateStripeAccountAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $user = $this->call('Authentication@GetAuthenticatedUserTask');

        // check, if this account does - in fact - belong to our user
        $accountId = $request->getInputByKey('id');
        $account = $this->call('Payment@GetStripeAccountByIdTask', [$accountId]);
        $paymentAccount = $account->paymentAccount;
        $this->call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        // we own this account - so it is safe to update it
        $data = $request->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
        ]);

        $account = $this->call('Stripe@UpdateStripeAccountTask', [$account, $data]);

        return $account;
    }
}
