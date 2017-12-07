<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class FindPaymentAccountDetailsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class FindPaymentAccountDetailsAction extends Action
{

    /**
     * @param $paymentAccountId
     *
     * @return  \App\Containers\Payment\Models\PaymentAccount
     */
    public function run($paymentAccountId): PaymentAccount
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Apiato::call('Payment@FindPaymentAccountByIdTask', [$paymentAccountId]);

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        return $paymentAccount;
    }
}
