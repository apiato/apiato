<?php

namespace App\Containers\Stripe\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Stripe\Models\StripeAccount;
use App\Ship\Parents\Actions\Action;

/**
 * Class UpdateStripeAccountAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateStripeAccountAction extends Action
{

    /**
     * @param $accountId
     * @param $sanitizedData
     *
     * @return  \App\Containers\Stripe\Models\StripeAccount
     */
    public function run($accountId, $sanitizedData): StripeAccount
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        // check, if this account does - in fact - belong to our user
        $account = Apiato::call('Payment@FindStripeAccountByIdTask', [$accountId]);
        $paymentAccount = $account->paymentAccount;
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        $account = Apiato::call('Stripe@UpdateStripeAccountTask', [$account, $sanitizedData]);

        return $account;
    }
}
