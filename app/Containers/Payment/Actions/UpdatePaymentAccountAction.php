<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class UpdatePaymentAccountAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdatePaymentAccountAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  \App\Containers\Payment\Models\PaymentAccount
     */
    public function run(Request $request): PaymentAccount
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Apiato::call('Payment@FindPaymentAccountByIdTask', [$request->id]);

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        $data = $request->sanitizeInput([
            'name'
        ]);

        $paymentAccount = Apiato::call('Payment@UpdatePaymentAccountTask', [$paymentAccount, $data]);

        return $paymentAccount;
    }
}
