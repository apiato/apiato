<?php

namespace App\Containers\Stripe\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Stripe\Models\StripeAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateStripeAccountAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateStripeAccountAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  \App\Containers\Stripe\Models\StripeAccount
     */
    public function run(Request $request): StripeAccount
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        // check, if this account does - in fact - belong to our user
        $account = Apiato::call('Payment@FindStripeAccountByIdTask', [$request->id]);
        $paymentAccount = $account->paymentAccount;
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        // we own this account - so it is safe to update it
        $data = $request->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
        ]);

        $account = Apiato::call('Stripe@UpdateStripeAccountTask', [$account, $data]);

        return $account;
    }
}
