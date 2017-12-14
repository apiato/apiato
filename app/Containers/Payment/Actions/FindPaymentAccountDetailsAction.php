<?php

namespace App\Containers\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Transporters\Transporter;

/**
 * Class FindPaymentAccountDetailsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class FindPaymentAccountDetailsAction extends Action
{

    /**
     * @param \App\Ship\Parents\Transporters\Transporter $data
     *
     * @return  \App\Containers\Payment\Models\PaymentAccount
     */
    public function run(Transporter $data): PaymentAccount
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Apiato::call('Payment@FindPaymentAccountByIdTask', [$data->id]);

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        return $paymentAccount;
    }
}
