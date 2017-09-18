<?php

namespace App\Containers\Stripe\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Stripe\Tasks\GetStripeAccountByIdTask;
use App\Containers\Stripe\Tasks\UpdateStripeAccountTask;
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
        $user = $this->call(GetAuthenticatedUserTask::class);

        // check, if this account does - in fact - belong to our user
        $accountId = $request->getInputByKey('id');
        $account = $this->call(GetStripeAccountByIdTask::class, [$accountId]);
        $paymentAccount = $account->paymentAccount;
        $this->call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $paymentAccount]);

        // we own this account - so it is safe to update it
        $data = $request->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
        ]);

        $account = $this->call(UpdateStripeAccountTask::class, [$account, $data]);

        return $account;
    }
}
